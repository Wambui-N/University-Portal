<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\teacher;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function redirect()
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == '0') {
                return view('student.dashboard');
            } 
            elseif (Auth::user()->usertype == '1') {
                $teachers = Teacher::with('courses')->get();
    
                return view('teacher.assets.overview', [
                    'teachers' => $teachers,
                ]);
            } 
            elseif (Auth::user()->usertype == '2') {
                return view('admin.assets.overview');
            }
        }
    }
}
