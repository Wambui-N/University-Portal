<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        //
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
    public function edit(Request $request, $id)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $email = $request->input('email');

        DB::table('users')->where('id', $id)->update([
            'name' => $name,
            'email' => $email,
            'email' => $email,

        ]);

        echo "Record updated successfully.";
        echo 'Click Here to go back.';
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();

        echo "Record deleted successfully.";
        echo 'Click Here to go back.';
    }
}
