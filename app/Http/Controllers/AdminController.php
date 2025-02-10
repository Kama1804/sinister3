<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
      // Attempt login with the admin guard
      if (Auth::guard('admin')->attempt([
        'username' => $credentials['username'], 
        'password' => $credentials['password']
    ], $request->remember)) {
        return redirect()->route('admin');  // Redirect to admin dashboard
    }

    // If authentication fails, return with error
    return back()->withErrors([
        'username' => 'Invalid credentials',
    ]);
}

    

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('status', 'Logged out successfully.');
    }
    
}