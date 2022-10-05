<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login()
    {
        return view('adminAuth.login');
    }

    public function loginSubmit(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'exists:admins,email', 'min:5'],
            'password' => ['required', 'string', 'min:8', 'max:50'],
        ]);
        $data = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($data)) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('admin.login')->with('error', __('app.login_error'));
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
