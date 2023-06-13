<?php

namespace App\Http\Controllers;

use App\Models\course;
use App\Models\courses_students;
use App\Models\student;
use App\Models\unit;
use App\Models\User;
use App\Models\Teacher;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with('units')->get();
        $teachers = Teacher::with('course')->get();
        $users = User::with('teacher')->get();
        $students = Student::all();
        $courses_students = courses_students::all();

        return view('student.assets.course_enrollment', [
            'courses' => $courses,
            'teachers' => $teachers,
            'users' => $users,
            'students' => $students,
            'courses_students' => $courses_students,
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
        $validatedData = $request->validate([
            'student_id' => 'required',
            'course_id' => 'required',
        ]);

        //get data from the form
        $ADM = $request->input('ADM');
        $code = $request->input('code');

        // Check if the student is already enrolled in the course
        $enrollment = DB::table('courses_students')
            ->where('ADM', $ADM)
            ->where('code', $code)
            ->first();

        if (!$enrollment) {
            //create a new enrollment
            $enrollment = new courses_students();
            $enrollment->ADM = $ADM;
            $enrollment->code = $code;
            $enrollment->save();
        }

        return redirect()->route('enrollments.index');
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
