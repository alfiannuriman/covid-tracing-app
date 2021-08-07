<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function storeLogin(LoginRequest $request)
    {
        if (Auth::attempt($request->only(['email', 'password']))) {
            return redirect('/user/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function register()
    {
        return view('auth.register');
    }

    public function storeRegister(RegisterRequest $request)
    {
        try {
            $user = new \App\Models\User;
            $alert_type = 'danger';
            $alert_title = 'Cannot register user, please try again';

            if ($user->register($request->all())) {
                $alert_type = 'success';
                $alert_title = 'Register success, please login to continue';
            }

            session()->flash('general.alert', [
                'type' => $alert_type,
                'title' => $alert_title,
            ]);

            return redirect('/auth/login');
        } catch (\Exception $e) {
            session()->flash('general.alert', [
                'type' => 'danger',
                'title' => 'Cannot register user, please try again',
            ]);

            return back();
        }
    }

    public function logout(Request $request)
    {
        try {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login');
        } catch (\Exception $e) {
            return redirect()->route('500');
        }
    }
}
