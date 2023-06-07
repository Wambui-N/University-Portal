<?php

namespace App\Http\Controllers;

use App\Models\unit;
use Illuminate\Http\Request;
use App\Helpers\Helper;
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
        $units = Unit::all();
        return view('teacher.assets.course_management', compact('units'));
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
            'courseId' => 'required|exists:courses,courseId',
        ]);

        // Find the course_Id
        $course = DB::table('courses')->where('courseId', $request->input('courseID'))->first();

        // Create a new unit instance
        $unit = new Unit();
        $unit->name = $request->input('name');
        $unit->code = Helper::NumberIDGenerator('units', [], 'UN-', 3);
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
    public function show(unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $unit = unit::find($id);
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
