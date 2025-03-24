<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view('log.login');
    }

    public function register(){
        return view('log.register');
    }

    public function logout(){
        Auth::logout();
        return view('log.login');
    }
}
