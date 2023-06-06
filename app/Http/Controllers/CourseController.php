<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $courseType = $request->query('course_type');
        $courses = Course::all();
        return view('admin.assets.course_management', compact('courses'));
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
    // Validate the form input
    $validatedData = $request->validate([
        'name' => 'required',
        'description' => 'required',
    ]);

    // Create a new course instance
    $course = new Course();
    $course->name = $request->input('name');
    $course->description = $request->input('description');

    // Generate code
    $course->code = Helper::NumberIDGenerator('courses', [], 'CO-', 3);

    // Generate course_id
    $course->courseId = Helper::NumberIDGenerator('courses', [], '', 3);

    $course->save();

    // Redirect to a relevant page or return a response as needed
    return redirect()->route('courses.index')->with('success', 'Course created successfully.');
}


    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $course = Course::find($id);
        return view('admin.assets.course_edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Find the course
        $course = Course::find($id);

        // Validate the form input
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        // Update the course's information
        $course->name = $request->input('name');
        $course->description = $request->input('description');
        $course->save();

        // Redirect to a relevant page or return a response as needed
        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table('courses')->where('id', $id)->delete();

        // Redirect to a relevant page or return a response as needed
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }
}
