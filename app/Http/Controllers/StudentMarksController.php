<?php

namespace App\Http\Controllers;

use App\Models\mark;
use App\Models\teacher;
use App\Models\course;
use App\Models\unit;
use Illuminate\Http\Request;

class StudentMarksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:student')->only('index');
    }
    public function index()
    {
        $marks = Mark::all();
        $courses = Course::with('units')->get();
        $teachers = Teacher::all();
        $courseId = request()->query('courseId');
        $units = unit::all();

        return view('student.assets.grade_book', [
            'marks' => $marks,
            'courses' => $courses,
            'teachers' => $teachers,
            'courseId' => $courseId,
            'units' => $units,
        ]);
    }
}
