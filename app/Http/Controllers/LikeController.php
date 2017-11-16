<?php

namespace App\Http\Controllers;

use App\User;

class LikeController extends Controller
{
    /**
     * Like.
     *
     * @param  string  $like
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
	public function like($like, $id)
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
                    $user->notify(new \App\Notifications\LikeComment($comment, $owner));
                }

                return $comment->like()->id;
                break;
        }
    }

    /**
     * Unlike.
     *
     * @param  string  $id
     * @return void
     */
    public function unlike($id)
    {
    	\App\Like::find($id)->delete();
    }
}
