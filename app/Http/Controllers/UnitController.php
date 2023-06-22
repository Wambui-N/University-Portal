<?php

namespace App\Http\Controllers;

use App\Models\unit;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;

class UnitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:1')->only('index');
        $this->middleware('role:1')->only('store');
        $this->middleware('role:1')->only('edit');
        $this->middleware('role:1')->only('update');
        $this->middleware('role:1')->only('show');
        $this->middleware('role:1')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $courseId = $request->query('courseId');
        $teachers = Teacher::with('courses')->get();
        $unitType = $request->query('unit_type');
        $course = Course::with('units')->findOrFail($courseId);
        return view('teacher.assets.units', [
            'course' => $course,
            'teachers' => $teachers,
            'unitType' => $unitType,
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
        // Generate unique identifier
        $unit_code = Helper::NumberIDGenerator('units', [], 'UN-', 3);

        // Validate the form input
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'courseId' => 'required',
        ]);

        //find the courseId on the course table
        $course = DB::table('courses')->where('courseId', $request->input('courseId'))->first();
        $courseId = $course->courseId;

        //retrieve the units from the course
        $units = DB::table('units')
            ->join('courses', 'units.courseId', '=', 'courses.courseId')
            ->where('courses.courseId', $courseId)
            ->count();

        // Check if the course has less than six units
        if ($units >= 6) {
            return redirect()->back()->withErrors('The course already has the maximum number of units.');
        }

        // Create a new unit instance
        $unit = new Unit();
        $unit->name = $request->input('name');
        $unit->description = $request->input('description');
        $unit->courseId = $courseId;
        $unit->code = $unit_code;

        $unit->save();

        // Redirect to a relevant page or return a response as needed
        return redirect()->route('units.index', ['courseId' => $course->id]);
    }



    /**
     * Display the specified resource.
     */
    public function show($course_id)
    {
        $course = Course::findOrFail($course_id);
        $units = $course->units;

        return view('teacher.assets.units', compact('units'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $unit = Unit::find($id);

        if (!$unit) {
            return redirect()->route('units.index')->withErrors('The selected unit does not exist.');
        }

        return view('teacher.assets.unit_edit', compact('unit'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        // Find the unit
        $unit = Unit::find($id);

        // Validate the form input
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'courseId' => ['required', Rule::exists('courses', 'courseId'),],
        ]);

        // Update the unit's information
        $unit->name = $request->input('name');
        $unit->description = $request->input('description');
        $unit->save();

        // Retrieve the course record
        $course = DB::table('courses')->where('courseId', $request->input('courseId'))->first();

        // Redirect to a relevant page or return a response as needed
        return redirect()->route('units.index', ['courseId' => $course->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        DB::table('units')->where('id', $id)->delete();

        // Retrieve the course record
        $course = DB::table('courses')->where('courseId', $request->input('courseId'))->first();

        // Redirect to a relevant page or return a response as needed
        return redirect()->route('units.index', ['courseId' => $course->id]);
    }
}
