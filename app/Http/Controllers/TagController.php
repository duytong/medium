<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
	/**
	 * Show the given tag.
	 * 
	 * @param  string $slug
	 * @return \Illuminate\View\View
	 */
	public function show($slug)
	{
		$tags = Tag::where('slug', '!=', $slug)->inRandomOrder()->take(9)->get();
		$tag = Tag::where('slug', $slug)->first();

		return view('tags.show', compact('tags', 'tag'));
	}

	/**
	 * Show the given latest posts.
	 * 
	 * @param  string $slug
	 * @return \Illuminate\View\View
	 */
	public function latest($slug)
	{
		$tags = Tag::where('slug', '!=', $slug)->inRandomOrder()->take(9)->get();
		$tag = Tag::where('slug', $slug)->first();

		return view('tags.latest', compact('tags', 'tag'));
	}

	/**
	 * Search tags via jQuery Tokeninput.
	 * 
	 * @param  Request $request
	 * @return \Illuminate\View\Response
	 */
    public function search(Request $request) {
        $keyword = request('q');
        $tags = Tag::where('slug', 'LIKE', '%' . $keyword . '%')->get();

        foreach ($tags as $tag) {
        	$assignedTag = \DB::table('post_tag')->where('tag_id', $tag->id)->count();
    		$tag['assigned_tag'] = $assignedTag;
        }
        
    	return response()->json($tags);
    }
}
