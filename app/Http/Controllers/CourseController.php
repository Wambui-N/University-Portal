<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Helpers\UserHelper;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:2')->only('index');
        $this->middleware('role:2')->only('store');
        $this->middleware('role:2')->only('show');
        $this->middleware('role:2')->only('update');
        $this->middleware('role:2')->only('destroy');
    }
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
        // Generate unique identifier
        //remove?????
        $admissionNumberPrefix = 'KU-';
        $admissionNumberLength = 6;
        $ADM = Helper::NumberIDGenerator('users', [], $admissionNumberPrefix, $admissionNumberLength);

        // Validate the form input
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'ADM' => ['required', Rule::exists('teachers', 'ADM'),],
        ]);

        // Find the teacher with the entered ADM value
        $teacher = DB::table('teachers')->where('ADM', $request->input('ADM'))->first();

        if (!$teacher) {
            // If teacher not found, return with error message
            $teacher = DB::table('teachers')->where('ADM', $request->input('ADM'))->first();
        }

        // Create a new course instance
        $course = new Course();
        $course->name = $request->input('name');
        $course->teacher_id = $teacher->id;
        // Generate code
        $course->code = Helper::NumberIDGenerator('courses', [], 'CO-', 3);
        $course->description = $request->input('description');

        // Generate course_id
        $course->courseId = Helper::NumberIDGenerator('courses', [], '', 3);

        $course->save();

        UserHelper::createUser($request->usertype, $ADM);

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

        //dd($id);
        // Find the course
        $course = Course::find($id);

        // Validate the form input
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'ADM' => ['required', Rule::exists('teachers', 'ADM')],
        ]);

        // Find the teacher with the entered ADM value
        $teacher = Teacher::where('ADM', $request->input('ADM'))->first();

        if (!$teacher) {
            // If teacher not found, return with error message
            return redirect()->back()->withErrors('Teacher not found.');
        }

        // Update the course's information
        $course->name = $request->input('name');
        $course->description = $request->input('description');
        $course->teacher_id = $teacher->id; // Associate the course with the teacher
        $course->update();

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
