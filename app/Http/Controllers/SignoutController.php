<?php

namespace App\Http\Controllers;

class SignoutController extends Controller
{
	/**
     * Logging out.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function signout()
    {
        auth()->logout();
        return back();
    }
}
