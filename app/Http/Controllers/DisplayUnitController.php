<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;

class DisplayUnitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:1')->only('index');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $teachers = Teacher::with('courses')->get();
        $teacherId = auth()->user()->teacher->id;
        $courses = Course::where('teacher_id', $teacherId)->get();
        return view('teacher.assets.courses', [
            'courses' => $courses,
            'teachers' => $teachers,
        ]);
    }

}
