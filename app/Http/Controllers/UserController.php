<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UserController extends Controller
{
    public function LoginForm(){
        return view('user\loginpage');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],

        ]);
        if (Auth::viaRemember()) {
            // ...
        }
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
}
    public function Logout(Request $request)
    {
        Auth::logout();

        return to_route('login');
    }
    public function SignupForm()
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
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        return redirect()->route('login')->with(['success' => 'User created successfully.']);
    }
}
