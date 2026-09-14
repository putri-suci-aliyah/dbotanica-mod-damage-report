<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.login.login');
    }

    public function login(Request $request)
    {
        $userName_or_email = $request->email;
        $password = $request->password;

        $user = User::where('name', $userName_or_email)->orWhere('email', $userName_or_email)->first();
        
        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user);
            return redirect()->to('dashboard');
        } else {
            return back()->withInput()->withErrors(['email' => 'User tidak ditemukan. Silahkan login kembali']);
        }   
    }

    public function logout()
    {
        Auth::logout();           // Log the user out
        request()->session()->invalidate();  // Invalidate the session
        request()->session()->regenerateToken(); // Regenerate CSRF token for security

        return redirect('/login'); // Redirect to login page or wherever you want
    }
}
