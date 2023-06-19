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
    public function index(Request $request)
    {
        $courseId = $request->query('courseId');
        $course = Course::with('units')->findOrFail($courseId);
        $courses = Course::with('units')->get();
        $enrollments = Courses_students::all();
        $teachers = Teacher::all();
        $units = Unit::with('course')->get();
        $users = User::with('student')->get();
        $students = Student::all();
        $marks = Mark::all();

        return view('teacher.assets.grade_management', [
            'course' => $course,
            'courses' => $courses,
            'enrollments' => $enrollments,
            'teachers' => $teachers,
            'users' => $users,
            'students' => $students,
            'units' => $units,
            'marks' => $marks,
            'courseId' => $courseId,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function fetch(Request $request, $courseId)
    {
        $courseId = $request->query('courseId');
        $enrollments = courses_students::where('courseId', $courseId)->with('student', 'course')->get();
        $students = [];

        foreach ($enrollments as $enrollment) {
            foreach ($enrollment->courses as $course) {
                if ($enrollment->code == $course->code && $course->courseId == $courseId) {
                    $students[] = $enrollment->ADM;
                }
            }
        }
        return response()->json($students);
    }

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
                'cat1' => 'required',
                'cat2' => 'required',
                'exam' => 'required',
            ]);
    
            // Create a new mark record
            $mark = new Mark();
            $mark->cat1 = $request->input('cat1');
            $mark->cat2 = $request->input('cat2');
            $mark->exam = $request->input('exam');
            $mark->save();
    
            // Redirect to a relevant page or return a response as needed
            return redirect()->route('grades.index');
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
    public function update(Request $request,$id)
    {
        // Find the mark record
        $mark = Mark::find($id);

        // Validate the form input
        $validatedData = $request->validate([
            'cat1' => 'required',
            'cat2' => 'required',
            'exam' => 'required',
        ]);

        // Update the mark's data
        $mark->cat1 = $request->input('cat1');
        $mark->cat2 = $request->input('cat2');
        $mark->exam = $request->input('exam');
        $mark->save();

        // Redirect to a relevant page or return a response as needed
        return redirect()->route('grades.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(mark $mark)
    {
        //
    }
}
