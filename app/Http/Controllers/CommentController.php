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
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function data(Request $request, $id)
    {
        if ($request->ajax()) {
            $post = Post::find($id);
            $comments = $post->comments()->orderBy('created_at', 'DESC')->paginate(10);
            $lastPage = $comments->lastPage();
            return view('posts.includes.comments', compact('comments', 'lastPage'));
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
}
