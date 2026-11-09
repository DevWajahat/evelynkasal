<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login_view()
    {
        return view('auth.admin.login');
    }

    public function login(LoginRequest $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 'admin'])) {

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => "Email Or Password Is Wrong"
        ])->onlyInput('email');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('admin.login');
    }
}
