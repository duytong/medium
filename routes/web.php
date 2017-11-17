<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

/**
 * Guest area
 */

// Pages
Route::get('/', 'PageController@welcome')->name('welcome');
Route::get('popular', 'PageController@postsPopular')->name('posts.popular');
Route::get('recommendation', 'PageController@postsRecommendation')->name('posts.recommendation');

// Connect
Route::get('signin/{provider}', 'Auth\SocialController@redirectToProvider');
Route::get('signin/{provider}/callback', 'Auth\SocialController@handleProviderCallback');
Route::get('signout', 'SignoutController@signout')->name('signout');

// Search
Route::get('search', 'SearchController@search')->name('search');
Route::get('autocomplete', 'SearchController@autocomplete');

// Topics
Route::get('topics', 'TopicController@index')->name('topics');
Route::get('topic/{slug}', 'TopicController@show');

// Show post
Route::get('@{author}/{slug}', 'PostController@show')->name('posts.show');

// Tags
Route::get('tag/{slug}', 'TagController@show')->name('tag.show');
Route::get('tag/{slug}/latest', 'TagController@latest')->name('tag.latest');
Route::get('search-tags', 'TagController@search');

// Profile
Route::get('@{username}', 'ProfileController@profile');
Route::get('@{username}/users/following', 'ProfileController@following')->name('following');
Route::get('@{username}/users/followers', 'ProfileController@followers')->name('followers');

/**
 * Administrator area
 */
Route::group(['prefix' => 'administrator', 'middleware' => 'administrator'], function () {
	Route::get('/', 'Administrator\PageController@dashboard')->name('dashboard');
	Route::view('posts', 'administrator.posts.index')->name('posts.index');

	// RESTful resource controllers
	Route::resource('users', 'Administrator\UserController', ['except' => ['show']]);
	Route::resource('categories', 'Administrator\CategoryController', ['except' => ['show']]);
	Route::resource('topics', 'Administrator\TopicController', ['except' => ['show']]);
	Route::resource('tags', 'Administrator\TagController', ['except' => ['show']]);
	
	// API controllers
	Route::get('api/categories', 'Administrator\ApiController@getCategoriesData')->name('categories.data');
	Route::get('api/topics', 'Administrator\ApiController@getTopicsData')->name('topics.data');
	Route::get('api/posts', 'Administrator\ApiController@getPostsData')->name('posts.data');
	Route::get('api/tags', 'Administrator\ApiController@getTagsData')->name('tags.data');
	Route::get('api/users', 'Administrator\ApiController@getUsersData')->name('users.data');
});

/**
 * User area
 */
Route::group(['middleware' => 'login'], function () {
	// Me
	Route::group(['prefix' => 'me'], function () {
		Route::group(['prefix' => 'posts'], function () {
			Route::get('drafts', 'UserController@draftPost')->name('drafts');
			Route::get('public', 'UserController@publicPost')->name('public');
		});
	});

	// Posts
	Route::resource('posts', 'PostController', ['only' => ['store', 'update', 'destroy']]);
	Route::get('new-post', 'PostController@create')->name('posts.create');
	Route::get('{id}/edit', 'PostController@edit')->name('posts.edit');

	// Bookmarks
	Route::get('browse/bookmarks', 'BookmarkController@index')->name('bookmarks');
	Route::post('bookmark/{bookmark}/{id}', 'BookmarkController@store');
	Route::post('unbookmark/{id}', 'BookmarkController@destroy');

	// Likes
	Route::post('like/{like}/{id}', 'LikeController@like');
	Route::post('unlike/{id}', 'LikeController@unlike');

	// Comments
	Route::post('post/comment', 'CommentController@comment');
	Route::get('{post}/comments', 'CommentController@data');

	// Followables
	Route::post('attach/{object}/{id}', 'FollowableController@attach');
	Route::post('detach/{object}/{id}', 'FollowableController@detach');

	// Mark notification as read
	Route::get('mark-as-read/{id}','NotificationController@markAsRead');
	Route::get('mark-all-as-read', function () {
		auth()->user()->unreadNotifications->markAsRead();
	});

	// Posts form followers
	Route::get('followers', 'PageController@postsFollowers')->name('posts.followers');
});
