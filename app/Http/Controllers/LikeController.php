<?php

namespace App\Http\Controllers;

use App\User;

class LikeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  string  $like
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
	public function store($like, $id)
    {
        switch ($like) {
            case 'post':
                $post = \App\Post::find($id);

                // Send notification.
                $id = $post->user->id;
                $user = User::where('id', $id)->first();
                $owner = auth()->user();

                if ($owner->id != $id) {
                    $user->notify(new \App\Notifications\LikePost($post, $owner));
                }

                return $post->like()->id;
                break;
            case 'comment':
                $comment = \App\Comment::find($id);

                // Send notification.
                $id = $comment->user->id;
                $user = User::where('id', $id)->first();
                $owner = auth()->user();

                if ($owner->id != $id) {
                $user->notificationtify(new \App\Notifications\LikeComment($comment, $owner));
                }

                return $comment->like()->id;
                break;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return void
     */
    public function destroy($id)
    {
    	\App\Like::find($id)->delete();
    }
}
