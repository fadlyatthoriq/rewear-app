<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        // Add rate limiting
        if (RateLimiter::tooManyAttempts($this->throttleKey($request), 5)) {
            $seconds = RateLimiter::availableIn($this->throttleKey($request));
            return back()->withErrors([
                'email' => 'Too many login attempts. Please try again in ' . $seconds . ' seconds.'
            ]);
        }

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            RateLimiter::hit($this->throttleKey($request));
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            RateLimiter::clear($this->throttleKey($request));
            $request->session()->regenerate();
            
            /** @var \App\Models\User $user */
            $user = Auth::user();
            
            // Log successful login
            Log::info('User logged in successfully', [
                'user_id' => $user->id,
                'email' => $user->email,
                'ip' => $request->ip()
            ]);
            
            // Redirect based on user role
            if ($user->isAdmin()) {
                Alert::success('Success', 'Welcome back, Admin!');
                return redirect('/admin/dashboard');
            }
            
            Alert::success('Success', 'Welcome back! You have successfully logged in.');
            return redirect('/');
        }

        RateLimiter::hit($this->throttleKey($request));

        Alert::error('Error', 'The provided credentials do not match our records.');
        return back()->withInput();
    }

    private function throttleKey(Request $request): string
    {
        return Str::transliterate(Str::lower($request->input('email')).'|'.$request->ip());
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'is_seller' => 'boolean',
            'store_name' => 'required_if:is_seller,1|nullable|string|max:100',
            'store_description' => 'required_if:is_seller,1|nullable|string',
            'terms' => 'required|accepted',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'birth_date' => $request->birth_date,
            'role' => 'user',
            'profile_picture' => 'assets-admin/static/images/avatar-default.svg',
            'is_seller' => $request->boolean('is_seller'),
        ];

        // Add seller-specific fields if is_seller is true
        if ($request->boolean('is_seller')) {
            $userData['store_name'] = $request->store_name;
            $userData['store_description'] = $request->store_description;
        }

        $user = User::create($userData);

        Auth::login($user);

        Alert::success('Success', 'Registration successful! Welcome to our platform.');
        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        Alert::success('Success', 'You have been successfully logged out.');
        return redirect('/login');
    }
} 