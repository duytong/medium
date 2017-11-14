<?php

namespace App\Http\Controllers;

class ProfileController extends Controller
{
	/**
     * Show the profile for the given user.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function profile($username)
    {
    	$profile = \App\User::where('username', $username)->first();
    	return view('users.pages.profile', compact('profile'));
    }

    /**
     * Show the following by this user.
     *
     * @param  int $id
     * @return \Illuminate\View\View
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
     * Show the followers by this user.
     *
     * @param  int $id
     * @return \Illuminate\View\View
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
