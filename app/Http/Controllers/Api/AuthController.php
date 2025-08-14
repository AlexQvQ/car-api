<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ], 201);
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = User::where('email', $request->email)->first();
        if(!$user){
            throw ValidationException::withMessages([
                'email' => ['ERROR']
            ]);
        }
        if(!Hash::check($request->password, $user->password)){
            throw ValidationException::withMessages([
                'email' => ['ERROR']
            ]);
        }
        $token = $user->createToken('apitoken')->plainTextToken;
        return response()->json([
            'token' => $token
        ]);
    }
    public function logout(Request $request){
        $request->user->tokens->delete();
        return response()->json([
            'message' => 'bye'
        ]);
    }
}


