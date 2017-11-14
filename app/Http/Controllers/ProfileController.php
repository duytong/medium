<?php

namespace App\Http\Controllers;

class ProfileController extends Controller
{
	/**
     * Show the profile.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function profile($username)
    {
    	$profile = \App\User::where('username', $username)->first();
    	return view('users.pages.profile', compact('profile'));
    }

    /**
     * Display a listing the user is following.
     *
     * @param  string   $id
     * @return \Illuminate\Http\Response
     */
    public function following($username)
    {
    	$profile = \App\User::where('username', $username)->first();
    	foreach ($profile->following as $value) {
    		$users[] = $value;
    	}

    	return view('users.pages.following', compact('profile', 'users'));
    }

    /**
     * Display a listing of followers.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function followers($username)
    {
    	$profile = \App\User::where('username', $username)->first();
    	foreach ($profile->followers as $value) {
    		$users[] = $value;
    	}

    	return view('users.pages.followers', compact('profile', 'users'));
    }
}
