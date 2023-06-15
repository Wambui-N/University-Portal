<?php

namespace App\Http\Controllers;

use App\Models\mark;
use App\Models\course;
use App\Models\user;
use App\Models\student;
use App\Models\courses_students;
use App\Models\teacher;
use App\Models\unit;
use Illuminate\Http\Request;

class GradesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with('units')->get();
        $enrollments = Courses_students::all();
        $teachers = Teacher::all();
        $units = Unit::with('course')->get();
        $users = User::with('student')->get();
        $students = Student::all();
        $marks = Mark::all();

        return view('teacher.assets.grade_management', [
            'courses' => $courses,
            'enrollments' => $enrollments,
            'teachers' => $teachers,
            'users' => $users,
            'students' => $students,
            'units' => $units,
            'marks' => $marks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(mark $mark)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(mark $mark)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, mark $mark)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(mark $mark)
    {
        //
    }
}
