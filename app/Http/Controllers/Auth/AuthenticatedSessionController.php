<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        if (Session::get('login_attempts', 0) >= 3) {
            return redirect()->route('login')->withErrors('Terlalu banyak percobaan login. Coba lagi nanti.');
        }

        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            Session::forget('login_attempts');

            if (Auth::user()->role != 'admin') {
                Auth::logout();
                return redirect()->route('login')->withErrors('Anda bukan admin.');
            }

            $request->session()->regenerate();

            return redirect()->intended(RouteServiceProvider::HOME);
        }

        $attemptsLeft = 3 - (Session::get('login_attempts', 0) + 1); 
        Session::put('login_attempts', Session::get('login_attempts', 0) + 1);

        return redirect()->route('login')->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
            'attempts_left' => $attemptsLeft
        ]);
    }
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
