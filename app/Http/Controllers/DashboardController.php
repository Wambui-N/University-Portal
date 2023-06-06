<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function redirect(){
        if(Auth::id()){
            if(Auth::user()->usertype=='0'){
                return view('student.dashboard');
            }
            elseif (Auth::user()->usertype=='1') {
                return view('teacher.dashboard');
            }
            elseif (Auth::user()->usertype=='2') {
                return view('admin.assets.default');
            }
        }
    }
}
