<?php

namespace App\Http\Controllers;

use App\User;
use App\Topic;
use App\Notifications\Follow;

class FollowableController extends Controller
{
	/**
     * Attach the given a row in followables table.
     *
     * @param  string  $object
     * @param  string  $id
     * @return void
     */
 	public function attach($object, $id)
	{
  		switch ($object) {
            case 'topic':
                $topic = Topic::find($id);
                auth()->user()->subscribe($topic);
                break;
            default:
                $user = User::find($id);
                auth()->user()->follow($user);
                $owner = auth()->user();

                // Send notification.
                $user->notify(new Follow($owner));
                break;
        }
	}

	/**
     * Detach the given a row in followables table.
     *
     * @param  string  $object
     * @param  string  $id
     * @return void
     */
	public function detach($object, $id)
	{
        $user = User::find(auth()->id());
        $user->notifications()->where('notifiable_id', $id)->delete();

	  	switch ($object) {
            case 'topic':
                $topic = Topic::find($id);
                auth()->user()->unsubscribe($topic);
                break;
            default:
                $user = User::find($id);
                auth()->user()->unfollow($user);
                break;
        }
	}
}
