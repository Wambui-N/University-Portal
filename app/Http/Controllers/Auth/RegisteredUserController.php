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
use App\Helpers\Helper;
use App\Helpers\UserHelper;

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
            'usertype' => ['required', 'in:student,teacher,admin'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $admissionNumberPrefix = 'KU-';
        $admissionNumberLength = 6;
        $ADM = Helper::NumberIDGenerator('users', [], $admissionNumberPrefix, $admissionNumberLength);

        $userTypeMappings = [
            'student' => 0,
            'teacher' => 1,
            'admin' => 2,
        ];

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'usertype' => $userTypeMappings[$request->usertype],
            'ADM' => $ADM,
        ]);

        event(new Registered($user));

        UserHelper::createUser($request->usertype, $ADM);


        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
