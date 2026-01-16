<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterLoginController extends Controller
{
    public function register_store(Request $request){
        $attrs = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|max:255',
            'confirmation_password' => 'required|string|max:255',
        ]);

        if($attrs['password'] != $attrs['confirmation_password']){
            return redirect()->back()->with('error', 'Password does not match.');
        }

        $status = 'Active';
        $role = 'Employee';

        User::create([
            'first_name' => $attrs['first_name'],
            'last_name' => $attrs['last_name'],
            'role' => $role,
            'status' => $status,
            'email' => $attrs['email'],
            'password' => Hash::make($attrs['password']),
        ]);

        return redirect()->route('login');
    }

    public function login_store(Request $request)
    {
        $attrs = $request->validate([
            'email'    => 'required|email|exists:users,email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt([
            'email'    => $attrs['email'],
            'password' => $attrs['password'],
        ])) {

            $request->session()->regenerate();

            $user = Auth::user();

            return match ($user->role) {
                'Employee' => redirect()->route('employee_home.display'),
                'Admin'    => redirect()->route('admin_home.display'),
                default    => redirect()->route('login')->with('error', 'Unauthorized role'),
            };
        }

        return back()
            ->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])
            ->withInput();
    }

}
