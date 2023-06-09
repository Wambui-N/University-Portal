<?php

namespace App\Http\Controllers;

use App\Models\unit;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $unitType = $request->query('unit_type');
        $courses = Course::with('units')->get(); // Eager load the units relationship
        return view('teacher.assets.units', compact('courses'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //F
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
            'courseId' => 'required|exists:courses,id',
        ]);

        // Find the course
        $course = Course::find($request->input('courseId'));

        // Check if the course has less than six units
        $unitCount = $course->units()->count();
        if ($unitCount >= 6) {
            return redirect()->back()->withErrors('The course already has the maximum number of units.');
        }

        // Create a new unit instance
        $unit = new Unit();
        $unit->name = $request->input('name');
        $unit->description = $request->input('description');

        // Associate the unit with the course
        $unit->course()->associate($course);

        $unit->save();

        // Redirect to a relevant page or return a response as needed
        return redirect()->route('units.index')->with('success', 'Unit added successfully.');
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

        // Redirect to a relevant page or return a response as needed
        return redirect()->route('units.index')->with('success', 'Unit updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table('units')->where('id', $id)->delete();

        // Redirect to a relevant page or return a response as needed
        return redirect()->route('units.index')->with('success', 'Unit deleted successfully.');
    }
}
