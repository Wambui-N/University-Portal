<?php

namespace App\Http\Controllers;

use App\Models\course;
use App\Models\courses_students;
use App\Models\student;
use App\Models\unit;
use App\Models\User;
use App\Models\Teacher;
use App\Models\students_units;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnrollmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:0')->only('index');
        $this->middleware('role:0')->only('store');
        $this->middleware('role:0')->only('show');
        $this->middleware('role:0')->only('update');
        $this->middleware('role:0')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with('units')->get();
        $teachers = Teacher::with('courses')->get();
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
        //validate the data
        $request->validate([
            'ADM' => 'required',
            'code' => 'required',
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
            //create a new enrollment(course_student)
            $enrollment = new courses_students();
            $enrollment->ADM = $ADM;
            $enrollment->code = $code;
            $enrollment->save();

            //create a new enrollment(student_unit)
            $courses = Course::with('units')->get();
            foreach ($courses as $course) {
                if ($course->code == $code) {
                    foreach ($course->units as $unit) {
                        $student_unit = new students_units();
                        $student_unit->ADM = $ADM;
                        $student_unit->code = $unit->code;
                        $student_unit->save();
                    }
                }
            }
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
