<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all(); // Retrieve all users from the database
        return view('admin.assets.user_management', compact('users'));
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

    /**
     * Show the form for editing the specified resource.
     */
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.assets.user_edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
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
    }
}
