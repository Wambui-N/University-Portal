<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\teacher;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class DisplayUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $unitType = $request->query('course_type');
        $teacherId = auth()->user()->teacher->id;
        $courses = Course::where('teacher_id', $teacherId)->get();
        return view('teacher.assets.courses', compact('courses'));
    }

}
