<?php

namespace App\Http\Controllers;

class NotificationController extends Controller
{
	/**
	 * Mark as read notification.
	 * 
	 * @param  string $id
	 * @return Illuminate\Http\Response
	 */
	public function markAsRead($id) {
		$user = auth()->user();
		$notification = $user->notifications()->where('id', $id)->first();
		$notification->update(['read_at' => \Carbon\Carbon::now()]);
	}
}
