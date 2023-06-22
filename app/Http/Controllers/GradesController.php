<?php

namespace App\Http\Controllers;

use App\Models\mark;
use App\Models\course;
use App\Models\user;
use App\Models\student;
use App\Models\courses_students;
use App\Models\students_units;
use App\Models\teacher;
use App\Models\unit;
use Illuminate\Http\Request;
use App\Notifications\MarksLoadedNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;


class GradesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:1')->only('index');
        $this->middleware('role:1')->only('fetch');
        $this->middleware('role:1')->only('notify');
        $this->middleware('role:1')->only('store');
        $this->middleware('role:1')->only('show');
        $this->middleware('role:1')->only('update');
        $this->middleware('role:1')->only('destroy');
    }
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



    public function fetch($unitId)
    {
        $students = students_units::where('code', $unitId)->get();
        foreach ($students as $student) {
            $stdnm = user::where('ADM', $student->ADM)->pluck('name')->first();
            $student->name = $stdnm;
        }

        return response()->json($students);
    }
    public function notify(Request $request)
    {
        $studentsWithMarks = Mark::distinct('ADM')->pluck('ADM');

        foreach ($studentsWithMarks as $adm) {
            $student = User::where('ADM', $adm)->first();
            if ($student) {
                Notification::send($student, new MarksLoadedNotification());
            }
        }

        return redirect()->back();
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
            'ADM' => 'required',
            'code' => 'required',
            'cat1' => 'required',
            'cat2' => 'required',
            'exam' => 'required',
        ]);

        // Create a new mark record
        $mark = new Mark();
        $mark->ADM = $request->input('ADM');
        $mark->code = $request->input('code');
        $mark->cat1 = $request->input('cat1');
        $mark->cat2 = $request->input('cat2');
        $mark->exam = $request->input('exam');

        //calculate total
        $cat = ($mark->cat1 + $mark->cat2) / 2;
        $total = $cat + $mark->exam;
        $mark->marks = $total;

        //calculate grade
        if ($total >= 70) {
            $mark->grade = 'A';
        } elseif ($total >= 60) {
            $mark->grade = 'B';
        } elseif ($total >= 50) {
            $mark->grade = 'C';
        } elseif ($total >= 40) {
            $mark->grade = 'D';
        } else {
            $mark->grade = 'E';
        }
        //save
        $mark->save();

        // Redirect to a relevant page or return a response as needed
        return redirect()->back();
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
    public function update(Request $request, $id)
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
        //calculate total
        $cat = ($mark->cat1 + $mark->cat2) / 2;
        $total = $cat + $mark->exam;
        $mark->marks = $total;

        //calculate grade
        if ($total >= 70) {
            $mark->grade = 'A';
        } elseif ($total >= 60) {
            $mark->grade = 'B';
        } elseif ($total >= 50) {
            $mark->grade = 'C';
        } elseif ($total >= 40) {
            $mark->grade = 'D';
        } else {
            $mark->grade = 'E';
        }
        //save
        $mark->save();

        // Redirect to a relevant page or return a response as needed
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(mark $mark)
    {
        //
    }
}
