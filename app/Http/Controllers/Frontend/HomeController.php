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
        return view('frontend.home.index');
    }

    public function instruction()
    {
        return view('frontend.home.instruction');
    }
}
