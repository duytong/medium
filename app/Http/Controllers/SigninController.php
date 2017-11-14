<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class SigninController extends Controller
{
    public function signin(Request $request)
    {
    	$credentials = [
    		'username' => request('username'),
    		'password' => request('password')
    	];

    	if (auth()->attempt($credentials)) {
    		return response()->json(['error' => false]);
    	} else {
    		$errors = new MessageBag(['error_signin' => 'The username or password is incorrect']);
    		return response()->json(['message' => $errors]);
    	}
    }
}
