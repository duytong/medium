<?php

namespace App\Http\Controllers;

use App\User;
use App\Topic;

class FollowableController extends Controller
{
	/**
     * Attach.
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
                $user->notify(new \App\Notifications\Follow($owner));
                break;
        }
	}

	/**
     * Detach.
     *
     * @param  string  $object
     * @param  string  $id
     * @return void
     */
	public function detach($object, $id)
	{
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
