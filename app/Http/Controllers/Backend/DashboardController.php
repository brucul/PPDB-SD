<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $title = "Dashboard";
        $sub_title = '
            <div class="breadcrumb-item">Dashboard</div>
        ';
        
        return view('backend.dashboard.index', compact('title', 'sub_title'));
    }
}
