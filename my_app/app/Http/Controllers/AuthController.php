<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request){

        return "Register";
    }

    public function login(Request $request){

        return "Login";
    }

    public function logout(Request $request){

        return "logout";
    }
}
