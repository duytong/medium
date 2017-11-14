<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
	public function markAsRead($id) {
		$user = auth()->user();
		$notification = $user->notifications()->where('id', $id)->first();
		if ($notification)
		{
			$notification->update(['read_at' => \Carbon\Carbon::now()]);
			return back();
		}
	}
}
