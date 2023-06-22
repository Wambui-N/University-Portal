<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;

class DropdownController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:1')->only('index');
    }
    public function index()
    {
        $teachers = Teacher::with('courses')->get();

        return view('teacher.dashboard', [
            'teachers' => $teachers,
        ]);
    }
}
