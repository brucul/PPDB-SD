<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        return view('frontend.home.index', compact('setting'));
    }

    public function instruction()
    {
        $setting = Setting::first();
        return view('frontend.home.instruction', compact('setting'));
    }
}
