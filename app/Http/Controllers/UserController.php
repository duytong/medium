<?php

namespace App\Http\Controllers;

use App\Post;

class UserController extends Controller
{
	/**
	 * Display a listing of draft posts.
	 *
	 * @return \Illuminate\View\View
	 */
    public function draftPost()
    {
    	$posts = Post::where([['status', 0], ['user_id', auth()->id()]])->get();
    	$countPublicPosts = Post::where([['status', 1], ['user_id', auth()->id()]])->count();

    	return view('users.posts.draft', compact('posts', 'countPublicPosts'));
    }

    /**
	 * Display a listing of public posts.
	 *
	 * @return \Illuminate\View\View
	 */
    public function publicPost()
    {
    	$posts = Post::where([['status', 1], ['user_id', auth()->id()]])->get();
    	$countDraftPosts = Post::where([['status', 0], ['user_id', auth()->id()]])->count();

    	return view('users.posts.public', compact('posts', 'countDraftPosts'));
    }
}
