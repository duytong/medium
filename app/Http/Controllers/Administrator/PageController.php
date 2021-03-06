<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;

class PageController extends Controller
{
	/**
     * Display dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
    	$users = \App\User::orderBy('created_at', 'DESC')->get();
    	$categories = \App\Category::all();
    	$topics = \App\Topic::all();
    	$posts = \App\Post::orderBy('created_at', 'DESC')->get();
    	$comments = \App\Comment::orderBy('created_at', 'DESC')->take(3)->get();

    	return view('administrator.pages.dashboard', compact('users', 'categories', 'topics', 'posts', 'comments'));
    }
}
