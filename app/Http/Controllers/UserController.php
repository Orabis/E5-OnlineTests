<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showLoginForm()
    {
        return view("login");
    }
    public function dashboard()
    {
        return view('prof.dashboard');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ], [
            'email.required' => 'L\'email est requis',
            'email.email' => 'Veuillez entrer un email valide',
            'password.required' => 'Le mot de passe est requis',
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->route('prof.dashboard');
        }
        return back()->withErrors([
            'email' => 'Les identifiants sont incorrects.',
        ]);
    }
    public function register(Request $request)
    {
        $request->validate([
            'register-name' => 'required|string|max:255',
            'register-email' => 'required|string|email|max:255|unique:users,email',
            'register-password' => 'required|string|min:6|confirmed',

        ], [
            'register-email.unique' => 'Cet email est déjà utilisé.',
            'register-password.confirmed' => 'Les mots de passe ne correspondent pas.',
            'register-password.min' => 'Le mot de passe doit contenir au moins 6 caractères',
        ]);

        $user = User::create([
            'name' => $request->input('register-name'),
            'email' => $request->input('register-email'),
            'password' => bcrypt($request->input('register-password')),
        ]);
        Auth::login($user);
        return redirect()->route('prof.dashboard');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
