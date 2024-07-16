<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class SignupController extends Controller
{
    public function index()
    {
        return view('user\signuppage');
    }
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => ['required','string','max:255'],
            'username' => ['required','string', 'max:255', 'unique:users'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required','string','min:8','confirmed'],
        ]);
        User::create([
            'name' => $validatedData['name'],
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => Hash::make($request->password),
            'image' => '/images/DefaultProfile.png',
            'remember_token' =>Str::random(10),
        ]);
        return to_route('verification.notice');
    }
}
