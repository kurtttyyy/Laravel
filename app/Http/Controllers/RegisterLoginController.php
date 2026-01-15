<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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

        $status = 'inactive';
        $role = 'employee';

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
}
