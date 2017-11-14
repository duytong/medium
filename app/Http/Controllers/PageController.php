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
     * @param  Request  $request
     * @return \Illuminate\View\View
     */
    public function welcome(Request $request)
    {
        $topics = Topic::all();
    	$popularPosts = Post::orderBy('view', 'DESC')->take(4)->get();

        if (auth()->check()) {
            // Get all of users that are following by this user.
            $followers = auth()->user()->users->all();

            foreach ($followers as $follower) {
                $userId[] = $follower->id;
            }

            if (!empty($userId)) {
                $postsFromFollowers = Post::whereIn('user_id', $userId)->orderBy('created_at', 'DESC')->take(4)->get();
            }

            // Get all of the topics that are subscribed by this user.
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
                $exploreMoreTopics = Topic::whereNotIn('id', $topicId)->take(3)->get();
            } else {
                $exploreMoreTopics = Topic::take(3)->get();
            }

            $recommendationPosts = Post::inRandomOrder()->take(4)->get();

            return view('pages.home.index', compact('popularPosts', 'postsFromFollowers', 'subscribedTopics', 'paginationTopics', 'lastPage', 'exploreMoreTopics', 'recommendationPosts'));
        }
    	return view('welcome', compact('topics', 'popularPosts'));
    }

    /**
     * Display a listing of posts popular.
     *
     * @param  Request  $request
     * @return \Illuminate\View\View
     */
    public function popular(Request $request)
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
     * @param  Request  $request
     * @return \Illuminate\View\View
     */
    public function followers(Request $request)
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
                return view('users.followers.data', compact('posts', 'lastPage'));
            }

            return view('users.followers.index', compact('posts', 'lastPage'));
        }

        return view('errors.404');
    }

    /**
     * Display a listing of posts random.
     *
     * @param  Request  $request
     * @return \Illuminate\View\View
     */
    public function recommendation(Request $request)
    {
        $posts = Post::inRandomOrder()->paginate(10);
        $lastPage = $posts->lastPage();

        if ($request->ajax()) {
            return view('pages.recommendation.data', compact('posts', 'lastPage'));
        }

        return view('pages.recommendation.index', compact('posts', 'lastPage'));
    }
}
