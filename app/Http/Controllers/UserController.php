<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Admin;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
        $userType = $request->query('user_type');

        $users = User::when($userType, function ($query, $userType) {
            if ($userType === 'teachers') {
                return $query->where('usertype', 1);
            } elseif ($userType === 'students') {
                return $query->where('usertype', 0);
            } elseif ($userType === 'admins') {
                return $query->where('usertype', 2);
            } else {
                return $query;
            }
        })
            ->get();

        return view('admin.assets.user_management', compact('users', 'userType'));
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
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required|in:student,teacher,admin',
        ]);

        // Create a new user instance
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));

        $role = $request->input('role');
        if ($role === 'student') {
            $user->usertype = 0;
        } elseif ($role === 'teacher') {
            $user->usertype = 1;
        } elseif ($role === 'admin') {
            $user->usertype = 2;
        }

        // Generate admission number
        $admissionNumberPrefix = 'KU-';
        $admissionNumberLength = 6;
        $user->ADM = Helper::NumberIDGenerator('users', [], $admissionNumberPrefix, $admissionNumberLength);

        $user->save();

        $role = $request->input('role');
        if ($role === 'student') {
            $student = new Student();
            // Populate the student-specific attributes
            $student->ADM = $request->input('ADM');
            // Associate the student with the user
            $user->student()->save($student);
        } elseif ($role === 'teacher') {
            $teacher = new Teacher();
            // Populate the teacher-specific attributes
            $teacher->ADM = $request->input('ADM');
            // Associate the teacher with the user
            $user->teacher()->save($teacher);
        } elseif ($role === 'admin') {
            $admin = new Admin();
            // Populate the admin-specific attributes
            $admin->ADM = $request->input('ADM');
            // Associate the admin with the user
            $user->admin()->save($admin);
        }

        // Redirect to a relevant page or return a response as needed
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.assets.user_edit', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    /**
     * Show the form for editing the specified resource.
     */
    public function update(Request $request, $id)
    {
        // Find the user
        $user = User::find($id);

        // Validate the form input
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'required|min:8',
            'role' => 'required|in:student,teacher,admin',
        ]);

        // Update the user's information
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));

        $role = $request->input('role');
        if ($role === 'student') {
            $user->usertype = 0;
        } elseif ($role === 'teacher') {
            $user->usertype = 1;
        } elseif ($role === 'admin') {
            $user->usertype = 2;
        }

        $user->save();

        // Redirect to a relevant page or return a response as needed
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();
        //redirect
        return redirect()->route('users.index')->with('success', 'Unit deleted successfully.');
    }
}
