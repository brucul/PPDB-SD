<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $title = "Dashboard";
        $sub_title = '
            <div class="breadcrumb-item">Dashboard</div>
        ';

        $student = Student::whereYear('created_at', substr(getSetting()->school_year, 0, 4))->get();
        $zonasi = $student->where('type', 1)->count();
        $prestasi = $student->where('type', 2)->count();
        $operator = User::role('operator')->count();
        
        return view('backend.dashboard.index', compact('title', 'sub_title', 'zonasi', 'prestasi', 'operator'));
    }
}
