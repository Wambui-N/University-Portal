<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::all(); // Retrieve all teachers from the database

        return view('admin/assets/user_management', compact('teachers'));
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
        // Validation
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'usertype' => 'required',
            'password' => 'required',
            // Add validation rules for other teacher attributes
        ]);

        // Create a new teacher
        $teacher = Teacher::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'usertype' => $validatedData['usertype'],
            'password' => $validatedData['password'],
            // Set other teacher attributes based on the validated data
        ]);

        // Perform any additional actions, such as assigning courses to the teacher

        // Redirect or return a response
        return redirect()->route('teachers.index')->with('success', 'Teacher added successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        //
    }
}
