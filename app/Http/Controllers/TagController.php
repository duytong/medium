<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
	/**
	 * Show tag.
	 * 
	 * @param  string  $slug
	 * @return \Illuminate\Http\Response
	 */
	public function show($slug)
	{
		$tags = Tag::where('slug', '!=', $slug)->inRandomOrder()->take(9)->get();
		$tag = Tag::where('slug', $slug)->first();

		return view('tags.show', compact('tags', 'tag'));
	}

	/**
	 * Show latest posts assigned this tag.
	 * 
	 * @param  string  $slug
	 * @return \Illuminate\Http\Response
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
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\JsonResponse
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
