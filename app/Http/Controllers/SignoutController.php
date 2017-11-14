<?php

namespace App\Http\Controllers;

class SignoutController extends Controller
{
	/**
     * Signing out.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function signout()
    {
        auth()->logout();
        return back();
    }
}
