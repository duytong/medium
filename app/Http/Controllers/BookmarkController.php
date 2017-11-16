<?php

namespace App\Http\Controllers;

use App\Bookmark;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    /**
     * Display a listing of bookmarks by a particular user.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function index(Request $request)
	{
		$bookmarks = Bookmark::where('user_id', auth()->id())->orderBy('created_at', 'DESC')->paginate(5);
        $lastPage = $bookmarks->lastPage();

        if ($request->ajax()) {
            return view('users.bookmarks.data', compact('bookmarks', 'lastPage'));
        }

		return view('users.bookmarks.index', compact('bookmarks', 'lastPage'));
	}

    /**
     * Create bookmark.
     * 
     * @param  string  $bookmark
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function store($bookmark, $id)
    {
        switch ($bookmark) {
            case 'post':
                $post = \App\Post::find($id);
                return $post->bookmark()->id;
                break;
            default:
                $comment = \App\Comment::find($id);
                return $comment->bookmark()->id;
                break;
        }
    }

    /**
     * Remove bookmark.
     * 
     * @param  sting  $id
     * @return void
     */
    public function destroy($id)
    {
    	Bookmark::find($id)->delete();
    }
}
