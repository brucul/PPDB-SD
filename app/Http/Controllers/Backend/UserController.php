<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Storage;
use App\Models\User;

class UserController extends Controller
{
    public function credentials($request, $password, $image)
    {
        return [
            'username' => $request->username,
            'name' => $request->name,
            'password' => $password,
            'image' => $image,
        ];
    }

    public function json() {
        $data = User::role('operator')->get();

        return datatables()->of($data)
            ->addColumn(
                'action',
                function ($row) {
                    $btn = '
                        <button class="btn btn-warning btn-edit" data-id="'.$row->id.'" title="Edit" data-toggle="modal" data-target="#editOperator"><i class="fa fa-edit"></i></button> 
                        <button class="btn btn-danger btn-delete" data-id="'.$row->id.'" data-name="'.$row->name.'" title="Delete"><i class="fa fa-trash"></i></button>
                    ';
                    return $btn;
                }
            )
            ->editColumn('image', function ($row) {
                $image = asset('assets/img/avatar/avatar-1.png');
                if ($row->image) {
                    $image = asset('storage/user/images/'.$row->image);
                }
                return '<img src="'.$image.'" width="100%">';
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at->format('d F Y - H:i:s');
            })
            ->rawColumns(['image', 'action'])
            ->addIndexColumn()
            ->make();
    }

    public function index()
    {
        $title = "Operator";
        $sub_title = '
            <div class="breadcrumb-item">List Operator</div>
        ';
        
        return view('backend.user.index', compact('title', 'sub_title'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => 'Data Found',
            'data' => $user,
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required|same:password|min:6',
            'image' => 'image|max:2048',
        ];
        $validator = Validator::make($request->all(), $rules);

        $input = array_fill_keys(array_keys($rules), null);
        $errors = array_merge($input, $validator->errors()->toArray());

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $errors,
            ]);
        }

        $password = bcrypt($request->password);
        $image = null;
        if ($request->file('image')) {
            $file = $request->file('image');
            $image = time().".".$file->extension();
            $file->storeAs('public/user/images/', $image);
        }

        $user = User::create($this->credentials($request, $password, $image));

        if ($user) {
            $user->assignRole('operator');
            return response()->json([
                'status' => true,
                'message' => 'Data Saved',
                'data' => $user,
            ]);
        } else {
            Storage::disk('public')->delete('user/images/' . $user->image);
            return response()->json([
                'status' => false,
                'errors' => ['Oops, something bad happened!'],
            ], 500);
        }
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $rules = [
            'name' => 'required',
            'username' => 'required|unique:users,username,'.$id,
            'password' => 'nullable|confirmed|min:6',
            'password_confirmation' => 'nullable|required_with:password|same:password|min:6',
            'image' => 'nullable|image|max:2048',
        ];
        $validator = Validator::make($request->all(), $rules);

        $input = array_fill_keys(array_keys($rules), null);
        $errors = array_merge($input, $validator->errors()->toArray());

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $errors,
            ]);
        }

        $user = User::findOrFail($id);
        $image = $user->image;
        $password = $user->password;

        if ($request->password) {
            $password = bcrypt($request->password);
        }

        if ($request->file('image')) {
            $file = $request->file('image');
            $image = time().".".$file->extension();
            $file->storeAs('public/user/images/', $image);
            Storage::disk('public')->delete('user/images/' . $user->image);
        }

        $update = $user->update($this->credentials($request, $password, $image));

        if ($update) {
            return response()->json([
                'status' => true,
                'message' => 'Data Updated',
                'data' => $user,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => ['Oops, something bad happened!'],
            ], 500);
        }
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        if ($user->delete()) {
            Storage::disk('public')->delete('user/images/' . $user->image);
            return response()->json([
                'status' => true,
                'message' => 'Data Deleted',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Oops, something bad happened!',
            ]);
        }
    }

    public function indexProfile()
    {
        $title = "Profile";
        $sub_title = '
            <div class="breadcrumb-item">Profile</div>
        ';
        $user = auth()->user();
        
        return view('backend.profile.index', compact('title', 'sub_title', 'user'));
    }

    public function updateProfile($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required|unique:users,username,'.$id,
            'password' => 'confirmed',
            'image' => 'image|max:2048',
        ]);

        if ($validator->fails()) {
            alert()->error('Error', $validator->messages()->all()[0]);
            return back()->withInput();
        }

        $user = User::findOrFail($id);
        $image = $user->image;
        $password = $user->password;

        if ($request->password) {
            $password = bcrypt($request->password);
        }

        if ($request->file('image')) {
            $file = $request->file('image');
            $image = time().".".$file->extension();
            $file->storeAs('public/user/images/', $image);
            Storage::disk('public')->delete('user/images/' . $user->image);
        }

        $user->update($this->credentials($request, $password, $image));
        activity('update')->withProperties(['user_agent' => $request->header('User-Agent')])->log('update profile');
        alert()->success('Success', 'Data Updated');
        return back();
    }
}
