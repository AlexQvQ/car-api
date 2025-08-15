<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required'],
            'vacancy' => ['required', 'string', 'max:255'],
        ]);

        User::create($validated = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'vacancy_id' => Vacancy::where('name', $request->vacancy)->first()->id,
        ]);
        return redirect('/');
    }

    public function login(Request $request){

        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();

            return redirect('/main');
        }

        return back()->withErrors([
            'email' => 'Логин или пароль введены не верно',
        ])->onlyInput('email');

    }

    public function logout(Request $request){

        Auth::logout();

        return redirect('/');

    }
}


