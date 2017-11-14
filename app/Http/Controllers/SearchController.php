<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
	/**
	 * Search posts via jQuery UI - Autocomplete.
	 * @param  Request $request
	 * @return \Illuminate\Http\Response
	 */
    public function autocomplete(Request $request)
    {
        $term = request('term');

    	$queries = \DB::table('posts')
    		->join('users', 'posts.user_id', '=', 'users.id')
    		->where('slug', 'LIKE', '%' . $term . '%')
    		->select('posts.*', 'users.*')
    		->take(5)
    		->get();

		if (count($queries) > 0) {
			foreach ($queries as $query) {
				$results[] = [
					'title' => $query->title,
					'slug' => $query->slug,
					'name' => $query->name,
					'username' => $query->username,
					'avatar' => $query->avatar
				];
			}
		} else {
			$results[] = '';
		}

    	return $results;
    }

    /**
	 * Display a listing search results.
	 *
	 * @param  Request $request
	 * @return \Illuminate\View\View
	 */
	public function search(Request $request)
	{
		$term = request('term');
		if ($term != '') {
			$posts = \App\Post::where('slug', 'LIKE', '%' . $term . '%')
				->orWhere('body', 'LIKE', '%' . $term . '%')
				->paginate(10);
		}
		
		return view('pages.search', compact('posts', 'term'));
	}
}
