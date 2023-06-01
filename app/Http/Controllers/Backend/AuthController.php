<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('backend.auth.login');
    }

    public function doLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "username"  =>  "required",
            "password"  =>  "required"
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->all()[0])->withInput();
        }

        $user = User::where('username', $request->username)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {

                Auth::attempt(['username' => $request->username, 'password' => $request->password], $request->remember ? true : false);

                return redirect()->route('be.index');
            }
            else {
                return back()->with("error", "Password Doesn't Match!")->withInput();
            }
        } else {
            return back()->with("error", "User Not Found!")->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('be.auth.login');
    }
}
