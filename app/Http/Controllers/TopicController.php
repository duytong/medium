<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * Display a listing of topics.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $categories = \App\Category::orderBy('name', 'ASC')->paginate(1);
        $lastPage = $categories->lastPage();

        foreach ($categories as $category) {
            $topics = $category->topics()->orderBy('name', 'ASC')->get();
        }

        if ($request->ajax()) {
            return view('topics.data', compact('categories', 'topics', 'lastPage'));
        }
        
        return view('topics.index', compact('categories', 'topics', 'lastPage'));
    }

    /**
     * Show the given topic.
     *
     * @return \Illuminate\View\View
     */
    public function show(Request $request, $slug)
    {
        $topic = Topic::where('slug', $slug)->first();

        $multipleCondition = [
            ['id', '!=', $topic->id],
            ['category_id', '=', $topic->category->id]
        ];

        $relatedTopics = Topic::inRandomOrder()->where($multipleCondition)->take(3)->get();
        $posts = $topic->posts()->paginate(4);
        $lastPage = $posts->lastPage();

        if ($request->ajax()) {
            return view('topics.posts.data', compact('posts', 'lastPage'));
        }

        return view('topics.show', compact('topic', 'relatedTopics', 'posts', 'lastPage'));
    }
}
