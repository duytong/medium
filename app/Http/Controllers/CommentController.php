<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Load more data via click event using ajax.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function data(Request $request, $id)
    {
        if ($request->ajax()) {
            $post = \App\Post::find($id);
            $comments = $post->comments()->orderBy('created_at', 'DESC')->paginate(10);
            $lastPage = $comments->lastPage();

            return view('posts.includes.comments', compact('comments', 'lastPage'));
        }
    }

    /**
     * Create a comment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function comment(Request $request)
    {
        $comment = \App\Comment::create([
            'user_id' => auth()->id(),
            'post_id' => request('post_id'),
            'body' => request('body')
        ]);

        // Send notification.
        $id = $comment->post->user->id;
        $user = \App\User::where('id', $id)->first();
        $owner = auth()->user();

        if ($owner->id != $id) {
            $user->notify(new \App\Notifications\NotificationComment($comment, $owner));
        }

        // Return data ajax.
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
