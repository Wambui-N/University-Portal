<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Admin;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'usertype' => 0,
        ]);

        switch ($user->usertype) {
            case 0: // Student
                Student::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'user_id' => $user->id,
                    //'additional_column' => 'value', // Add any additional columns specific to the student table
                ]);
                break;
            case 1: // Teacher
                Teacher::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'user_id' => $user->id,
                    //'additional_column' => 'value', // Add any additional columns specific to the teacher table
                ]);
                break;
            case 2: // Admin
                Admin::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'user_id' => $user->id,
                    //'additional_column' => 'value', // Add any additional columns specific to the admin table
                ]);
                break;
            default:
                // Handle invalid user type
                break;
        }


        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
