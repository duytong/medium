<?php

namespace App\Http\Controllers\Admin;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
	/**
     * Categories.
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCategoriesData()
    {
    	$categories = DB::table('categories')
    		->leftJoin('topics', 'categories.id', '=', 'topics.category_id')
    		->select('categories.*', DB::raw('count(topics.category_id) AS count'))
    		->groupBy('id');

    	return datatables($categories)
            ->editColumn('created_at', function ($topic) {
            	return date('d M, Y', strtotime($topic->created_at));
            })
            ->addColumn('actions', function ($category) {
            	return 	'<div class="dropdown">
            				<a href="actions" title="Actions" data-toggle="dropdown">
            					<i class="la la-ellipsis-h"></i>
            				</a>
			            	<div class="dropdown-menu dropdown-menu-right dropdown-actions">
			            		<a href="' . route('categories.edit', $category->id) . '" class="dropdown-item">
			            			<i class="la la-edit"></i> Edit
			            		</a>
			            		<form action="' . route('categories.destroy', $category->id) . '" method="POST" class="form-delete">
		            				<input name="_method" type="hidden" value="DELETE">
		                            <input type="hidden" name="_token" value="' . csrf_token() . '">
		                            <span class="dropdown-item bg-none">
                                        <button class="bg-none"><i class="la la-trash"></i> Delete</button>
                                    </span>
		            			</form>
			            	</div>
            			</div>';
            })
            ->rawColumns(['actions'])
    		->make(true);
    }

	/**
     * Topics.
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTopicsData()
    {
    	$topics = DB::table('topics')
    		->leftJoin('categories', 'topics.category_id', '=', 'categories.id')
    		->leftJoin('posts', 'topics.id', '=', 'posts.topic_id')
    		->select('topics.*', 'categories.name AS category', DB::raw('count(posts.topic_id) AS count'))
    		->groupBy('id');

    	return datatables($topics)
    		->editColumn('name', function ($topic) {
                return '<a href="topic/' . $topic->name . '" title="' . $topic->name . '" target="_blank">' . $topic->name . '</a>';
            })
    		->editColumn('image', function ($topic) {
                return '<img src="storage/topics/' . $topic->image . '" style="width: 100px;">';
            })
            ->editColumn('created_at', function ($topic) {
            	return date('d M, Y', strtotime($topic->created_at));
            })
            ->addColumn('actions', function ($topic) {
            	return 	'<div class="dropdown">
            				<a href="actions" title="Actions" data-toggle="dropdown">
            					<i class="la la-ellipsis-h"></i>
            				</a>
			            	<div class="dropdown-menu dropdown-menu-right dropdown-actions">
			            		<a href="' . route('topics.edit', $topic->id) . '" class="dropdown-item">
			            			<i class="la la-edit"></i> Edit
			            		</a>
			            		<form action="' . route('topics.destroy', $topic->id) . '" method="POST" class="form-delete">
                                    <input name="_method" type="hidden" value="DELETE">
                                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                                    <span class="dropdown-item bg-none">
                                        <button class="bg-none"><i class="la la-trash"></i> Delete</button>
                                    </span>
                                </form>
			            	</div>
            			</div>';
            })
            ->rawColumns(['name', 'image', 'actions'])
    		->make(true);
    }

    /**
     * Posts.
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPostsData()
    {
        $posts = DB::table('posts')
            ->join('topics', 'posts.topic_id', '=', 'topics.id')
        	->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'topics.name AS topic', 'topics.slug AS topic_slug', 'users.name AS author', 'users.username');

        return datatables($posts)
            ->editColumn('title', function ($post) {
                return '<a href="@' . $post->username . '/' . $post->slug . '" title="' . $post->title . '" target="_blank">' . $post->title . '</a>';
            })
            ->editColumn('image', function ($post) {
                return '<img src="storage/posts/' . $post->image . '" style="width: 100px;">';
            })
            ->editColumn('author', function ($post) {
                return '<a href="@' . $post->username . '" class="text-danger" title="' . $post->author . '" target="_blank">' . $post->author . '</a>';
            })
            ->editColumn('topic', function ($post) {
                return '<a href="topic/' . $post->topic_slug . '" class="text-info" title="' . $post->topic . '" target="_blank">' . $post->topic . '</a>';
            })
            ->addColumn('actions', function ($post) {
            	return 	'<div class="dropdown">
            				<a href="actions" title="Actions" data-toggle="dropdown">
            					<i class="la la-ellipsis-h"></i>
            				</a>
			            	<div class="dropdown-menu dropdown-menu-right dropdown-actions">
			            		<a href="' . route('posts.edit', $post->id) . '" class="dropdown-item">
			            			<i class="la la-edit"></i> Edit
			            		</a>
			            		<form action="' . route('posts.destroy', $post->id) . '" method="POST" class="form-delete">
                                    <input name="_method" type="hidden" value="DELETE">
                                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                                    <span class="dropdown-item bg-none">
                                        <button class="bg-none"><i class="la la-trash"></i> Delete</button>
                                    </span>
                                </form>
			            	</div>
            			</div>';
            })
            ->rawColumns(['title', 'image', 'author', 'topic', 'actions'])
            ->make(true);
    }

    /**
     * Tags.
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTagsData()
    {
        $tags = DB::table('tags')
            ->leftJoin('post_tag', 'tags.id', '=', 'post_tag.tag_id')
            ->select('tags.*', DB::raw('count(post_tag.tag_id) AS count'))
            ->groupBy('id');

        return datatables($tags)
            ->editColumn('name', function ($tag) {
                return '<a href="tag/' . $tag->slug . '" title="' . $tag->name . '" target="_blank">' . $tag->name . '</a>';
            })
            ->editColumn('created_at', function ($tag) {
                return date('d M, Y', strtotime($tag->created_at));
            })
            ->addColumn('actions', function ($tag) {
                return  '<div class="dropdown">
                            <a href="actions" title="Actions" data-toggle="dropdown">
                                <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-actions">
                                <a href="' . route('tags.edit', $tag->id) . '" class="dropdown-item">
                                    <i class="la la-edit"></i> Edit
                                </a>
                                <form action="' . route('tags.destroy', $tag->id) . '" method="POST" class="form-delete">
                                    <input name="_method" type="hidden" value="DELETE">
                                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                                    <span class="dropdown-item bg-none">
                                        <button class="bg-none"><i class="la la-trash"></i> Delete</button>
                                    </span>
                                </form>
                            </div>
                        </div>';
            })
            ->rawColumns(['name', 'actions'])
            ->make(true);
    }

    /**
     * Users.
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUsersData()
    {
        $users = DB::table('users')
            ->leftJoin('posts', 'users.id', '=', 'posts.user_id')
            ->leftJoin('followables', 'users.id', '=', 'followables.followable_id')
            ->select('users.*', DB::raw('count(posts.user_id) AS posts'), DB::raw('count(followables.followable_id) AS followers'))
            ->groupBy('id');

        return datatables($users)
            ->editColumn('name', function ($user) {
                return '<a href="@' . $user->username . '" title="' . $user->name . '" target="_blank">' . $user->name . '</a>';
            })
            ->editColumn('avatar', function ($user) {
                return '<img src="storage/users/' . $user->avatar . '" style="width: 100px;">';
            })
            ->editColumn('count', function ($user) {
                return  '<div class="d-flex flex-column">
                            <span><i class="flaticon-list mr-3"></i>' . $user->posts . '</span>
                            <span><i class="flaticon-users mr-3"></i>' . $user->followers . '</span>
                        </div>';
            })
            ->editColumn('role', function ($user) {
                return $user->role == 1 ? '<span class="text-danger">Adminstrator</span>' : 'User';
            })
            ->editColumn('created_at', function ($user) {
                return date('d M, Y', strtotime($user->created_at));
            })
            ->addColumn('actions', function ($user) {
                return  '<div class="dropdown">
                            <a href="actions" title="Actions" data-toggle="dropdown">
                                <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-actions">
                                <a href="' . route('users.edit', $user->id) . '" class="dropdown-item">
                                    <i class="la la-edit"></i> Edit
                                </a>
                                <form action="' . route('users.destroy', $user->id) . '" method="POST" class="form-delete">
                                    <input name="_method" type="hidden" value="DELETE">
                                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                                    <span class="dropdown-item bg-none">
                                        <button class="bg-none"><i class="la la-trash"></i> Delete</button>
                                    </span>
                                </form>
                            </div>
                        </div>';
            })
            ->rawColumns(['name', 'avatar', 'count', 'role', 'actions'])
            ->make(true);
    }
}
