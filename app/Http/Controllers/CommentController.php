<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use Illuminate\Http\Request;
use App\Notifications\NotificationComment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        if ($request->ajax()) {
            $post = Post::find($id);
            $responses = $post->responses()->orderBy('created_at', 'DESC')->paginate(5);
            $lastPage = $responses->lastPage();
            return view('stories.includes.responses', compact('responses', 'lastPage'));
        }
    }

    /**
     * Create a comment.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $comment = Comment::create([
            'user_id' => auth()->id(),
            'post_id' => request('post_id'),
            'body' => request('body')
        ]);

        // Send notification
        $username = $comment->post->user->username;
        $user = \App\User::where('username', $username)->first();
        $user->notify(new NotificationComment($comment));

        // Return data ajax
        return response()->json([
            'id' => '.' . $comment->id . '.',
            'path' => $comment->path(),
            'user_name' => $comment->user->name,
            'user_path' => $comment->user->path(),
            'user_path_image' => $comment->pathImageUser(),
            'body' => $comment->body,
            'created_at' => $comment->createdAt()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($owner, $slug, $id)
    {
    	$response = Response::where('id', $id)->first();
        $randomStories = post::inRandomOrder()->where('id', '!=', $response->post->id)->take(3)->get();
        $replies = $response->replies()->paginate(5);
        $lastPage = $replies->lastPage();
    	return view('stories.includes.replies.index', compact('response', 'randomStories', 'replies', 'lastPage'));
    }
}
