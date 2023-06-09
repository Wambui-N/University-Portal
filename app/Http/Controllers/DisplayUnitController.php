<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class DisplayUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $unitType = $request->query('unit_type');
        $courses = Course::with('units')->get(); // Eager load the units relationship
        return view('teacher.assets.courses', compact('courses'));
    }

}
