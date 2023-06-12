<?php

namespace App\Http\Controllers;
use App\Models\course;
use App\Models\courses_students;
use App\Models\unit;
use App\Models\Teacher;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with('units,teacher')->get();
        return view('student.assets.course_enrollment', compact('courses,units,teachers'));
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
    public function show(courses_students $courses_students)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(courses_students $courses_students)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, courses_students $courses_students)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(courses_students $courses_students)
    {
        //
    }
}
