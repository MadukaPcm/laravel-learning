<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6'
        ]);

        $user_exists = User::where('email', $request->email)->exists();
        if($user_exists){
            return [
                'error' => true,
                'message' => 'User already exists!',
                'data' => null
            ];
        }

        $user = User::create($validatedData);
        $token = $user->createToken($request->name);

        return [
            'error' => false,
            'message' => 'User registered successfully!',
            'data' => [
                'user' => $user,
                'token' => $token->plainTextToken
                ]
            ];
    }

    public function login(Request $request){

        $payload = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $payload['email'])->first();
        if(!$user || !Hash::check($payload['password'], $user->password)){
            return [
                'error' => true,
                'message' => 'Invalid login credentials',
                'data' => null
            ];
        }

        $token = $user->createToken($user->name);

        return [
            'error' => false,
            'message' => 'User logged in successfully!',
            'data' => [
                'user' => $user,
                'token' => $token->plainTextToken
            ]
        ];
    }

    public function logout(Request $request){

        $request->user()->tokens()->delete();

        return [
            'error' => false,
            'message' => 'User logged out successfully!',
            'data' => null
        ];
    }
}
