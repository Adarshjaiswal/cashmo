<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:10|min:10',
            'aadhar_number' => 'required|numeric|digits:12',
            'pan_number' => 'required|string|max:10',
            'email' => 'required|string|email|max:255|unique:users',
            'pincode' => 'required|numeric|digits:6',
            'firm_name' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'address' => 'required|string|max:255',
        ]);

        // Split full_name into first_name and last_name
        $nameParts = explode(' ', $request->full_name);
        $first_name = $nameParts[0];
        $last_name = isset($nameParts[1]) ? $nameParts[1] : '';

        $user = User::create([
            'username' => strtolower($first_name).strtolower($last_name),
            'first_name' => $first_name,
            'last_name' => $last_name,
            'phone_number' => $request->phone_number,
            'aadhar_number' => $request->aadhar_number,
            'pan_number' => $request->pan_number,
            'email' => $request->email,
            'pincode' => $request->pincode,
            'firm_name' => $request->firm_name,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'user_type' => 'user',
        ]);

        $user->assignRole('user');

        event(new Registered($user));

        // Redirect the user to the login page after successful registration
        return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    }


}
