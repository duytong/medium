<?php

namespace App\Http\Controllers;

use App\Post;
use App\Topic;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of posts from home.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function welcome(Request $request)
    {
        $topics = Topic::all();
    	$postsPopular = Post::orderBy('view', 'DESC')->take(4)->get();

        if (auth()->check()) {
            // Get all of the users followed by a particular user.
            $followers = auth()->user()->users->all();

            foreach ($followers as $follower) {
                $userId[] = $follower->id;
            }

            if (!empty($userId)) {
                $postsFollowers = Post::whereIn('user_id', $userId)->orderBy('created_at', 'DESC')->take(4)->get();
            }

            // Get all of the topics subscribed by a particular user.
            $subscribedTopics = auth()->user()->topics->all();

            foreach ($subscribedTopics as $subscribedTopic) {
                $topicId[] = $subscribedTopic->id;
            }

            // Pagination for subscribed topics via scroll event using ajax.
            if (!empty($topicId)) {
                $paginationTopics = $subscribedTopic->whereIn('id', $topicId)->paginate(3);
                $lastPage = $paginationTopics->lastPage();

                if ($request->ajax()) {
                    return view('pages.home.data', compact('paginationTopics', 'lastPage'));
                }
            }

            // Get all of the topics except subscribed topics.
            if (!empty($topicId)) {
                $exploreTopics = Topic::whereNotIn('id', $topicId)->take(3)->get();
            } else {
                $exploreTopics = Topic::take(3)->get();
            }
            
            $postsRecommendation = Post::inRandomOrder()->take(4)->get();

            return view('pages.home.index', compact('postsPopular', 'postsFollowers', 'subscribedTopics', 'paginationTopics', 'lastPage', 'exploreTopics', 'postsRecommendation'));
        }

    	return view('welcome', compact('topics', 'postsPopular'));
    }

    /**
     * Display a listing of posts popular.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postsPopular(Request $request)
    {
    	$posts = Post::orderBy('view', 'DESC')->paginate(10);
        $lastPage = $posts->lastPage();

        if ($request->ajax()) {
            return view('pages.popular.data', compact('posts', 'lastPage'));
        }

    	return view('pages.popular.index', compact('posts', 'lastPage'));
    }

    /**
     * Display a listing of posts from follwers.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postsFollowers(Request $request)
    {
        if (auth()->check()) {
            // Get all of users that are following by this user.
            $followers = auth()->user()->users->all();

            foreach ($followers as $follower) {
                $userId[] = $follower->id;
            }

            $posts = Post::whereIn('user_id', $userId)->orderBy('created_at', 'DESC')->paginate(10);
            $lastPage = $posts->lastPage();

            if ($request->ajax()) {
                return view('users.posts.followers.data', compact('posts', 'lastPage'));
            }

            return view('users.posts.followers.index', compact('posts', 'lastPage'));
        }

        return view('errors.404');
    }

    /**
     * Display a listing of posts recommendation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postsRecommendation(Request $request)
    {
        $posts = Post::inRandomOrder()->paginate(10);
        $lastPage = $posts->lastPage();

        if ($request->ajax()) {
            return view('pages.recommendation.data', compact('posts', 'lastPage'));
        }

        return view('pages.recommendation.index', compact('posts', 'lastPage'));
    }
}
