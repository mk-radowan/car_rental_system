<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (auth()->check()) {
            return $this->redirectByRole();
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'redirect' => ['nullable', 'string'],
        ]);

        $credentials = [
            'email' => $validated['email'],
            'password' => $validated['password'],
        ];

        $redirect = $this->sanitizeRedirectPath($validated['redirect'] ?? null);

        if ($redirect) {
            $request->session()->put('url.intended', $redirect);
        }

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            if (!Auth::user()->is_active) {
                Auth::logout();

                return back()->withErrors([
                    'email' => 'Your account is disabled. Please contact admin.',
                ])->onlyInput('email');
            }

            $request->session()->regenerate();

            if (Auth::user()->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->onlyInput('email', 'redirect');
    }

    public function showRegister()
    {
        if (auth()->check()) {
            return $this->redirectByRole();
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique(User::class, 'email')],
            'phone' => ['required', 'digits:11'],
            'phone' => ['max:13'],

            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'role' => ['required', Rule::in(['admin', 'customer'])],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return $this->redirectByRole()
            ->with('success', 'Registration successful! Welcome to Pothik Rentals.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')
            ->with('success', 'Logged out successfully.');
    }

    protected function redirectByRole()
    {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('dashboard');
    }

    private function sanitizeRedirectPath(?string $redirect): ?string
    {
        if (!$redirect) {
            return null;
        }

        $path = trim($redirect);

        if ($path === '' || strpos($path, '//') === 0 || strpos($path, '\\') === 0) {
            return null;
        }

        if (preg_match('/^[a-z][a-z0-9+.-]*:/i', $path)) {
            return null;
        }

        return str_starts_with($path, '/') ? $path : null;
    }
}
