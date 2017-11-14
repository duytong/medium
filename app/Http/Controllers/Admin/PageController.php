<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
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
    	$users = User::orderBy('created_at', 'DESC')->get();
    	$categories = \App\Category::all();
    	$topics = \App\Topic::all();
    	$posts = \App\Post::orderBy('created_at', 'DESC')->get();
    	$comments = \App\Comment::orderBy('created_at', 'DESC')->take(3)->get();

    	return view('admin.pages.dashboard', compact('users', 'categories', 'topics', 'posts', 'comments'));
    }
}
