<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        
        $payload = $request->validate([
            'name'=>'required|string|max:256',
            'role'=>'required|string|max:50',
            'dob'=>'required|date',
            'email'=>'required|email|max:200',
            'password'=>'required|min:6|max:12|confirmed'
        ]);

        $user_instance = User::where('email',$payload['email'])->first();
        if($user_instance){
            return [
                'error'=>true,
                'message'=>'User with provided email already exist!',
                'data'=>null
            ];
        }

        $user = User::create([
            'name'=>$payload['name'],
            'role'=>$payload['role'],
            'dob'=>$payload['dob'],
            'email'=>$payload['email'],
            'password'=>Hash::make($payload['password'])
        ]);

        if(!$user){
            return [
                'error'=>true,
                'message'=>'An error occured during processing the request!',
                'data'=>null
            ];
        }

        $token = $user->createToken($payload['name']);

        return [
            'error'=>false,
            'message'=>'User created successfully!',
            'data'=>[
                'user'=>$user,
                'token'=>$token->plainTextToken
            ]
        ];
    }

    public function login(Request $request){
        $payload = $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        $user = User::where('email',$payload['email'])->first();
        if(!$user || !Hash::check($payload['password'],$user->password)){
            return [
                'error'=>true,
                'message'=>'Invalid email or password provided!',
                'data'=>null
            ];
        }

        $token = $user->createToken($user->name);

        return [
            'error'=>false,
            'message'=>'Successfully logged in!',
            'data'=>[
                'user'=>$user,
                'token'=>$token->plainTextToken
                ]
            ];
    }

    public function logout(Request $request){

        // Getting and deleting user tokens.
        $request->user()->tokens()->delete();

        return [
            'error'=>false,
            'message'=>'Successfully logged out!',
            'data'=>null
        ];
    }

    public function users(Request $request){

        $users = User::all();
        if($users->count() <= 0){
            return [
                'error'=>true,
                'message'=>'NO DATA FOUND',
                'data'=>null
            ];
        }

        return [
            'error'=>false,
            'message'=>'Success',
            'data'=>$users
        ];
    }
}