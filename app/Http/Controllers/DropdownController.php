<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;

class DropdownController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with('courses')->get();

        return view('teacher.dashboard', [
            'teachers' => $teachers,
        ]);
    }
}
