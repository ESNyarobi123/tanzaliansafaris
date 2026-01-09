<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;

class AuthController extends Controller
{
    public function showSignin()
    {
        return view('auth.signin');
    }

    public function signin(Request $request)
    {
        // Store redirect_after_login from query parameter if present
        if ($request->has('redirect_after_login')) {
            $request->session()->put('redirect_after_login', $request->query('redirect_after_login'));
        }

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Incorrect email or password.'])->withInput();
        }

        if ($user->status !== 'active') {
            return back()->withErrors(['email' => 'Your account is inactive. Please contact support.'])->withInput();
        }

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();

            // Check for redirect after login (from booking page or form)
            $redirectAfterLogin = $request->input('redirect_after_login') ?? $request->session()->get('redirect_after_login');
            if ($redirectAfterLogin) {
                $request->session()->forget('redirect_after_login');
                return redirect($redirectAfterLogin);
            }

            if ($user->role === 'super_admin' || $user->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            }

            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors(['email' => 'Incorrect email or password.'])->withInput();
    }

    public function showSignup()
    {
        return view('auth.signup');
    }

    public function signup(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['nullable', 'string', 'max:50'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'] ?? null,
            'role' => 'staff', // Default role
            'status' => 'active',
        ]);

        try {
            Mail::to($user->email)->send(new WelcomeEmail($user));
        } catch (\Exception $e) {
            // Log error but don't stop the signup process
            \Log::error('Failed to send welcome email: ' . $e->getMessage());
        }

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
