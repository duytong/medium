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

// Homepage
Route::get('/', 'PageController@welcome')->name('welcome');

// Connect
Route::get('signin/{provider}', 'Auth\SocialController@redirectToProvider');
Route::get('signin/{provider}/callback', 'Auth\SocialController@handleProviderCallback');
Route::get('signout', 'SignoutController@signout')->name('signout');

Route::view('login', 'admin.pages.login');

// Area administrator
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
	Route::get('/', 'Admin\PageController@dashboard')->name('dashboard');
	Route::view('posts', 'admin.posts.index')->name('posts.index');

	// RESTful resource controllers
	Route::resource('users', 'Admin\UserController', ['except' => ['show']]);
	Route::resource('categories', 'Admin\CategoryController', ['except' => ['show']]);
	Route::resource('topics', 'Admin\TopicController', ['except' => ['show']]);
	Route::resource('tags', 'Admin\TagController', ['except' => ['show']]);
	
	// API controllers
	Route::get('api/categories', 'Admin\ApiController@getCategoriesData')->name('categories.data');
	Route::get('api/topics', 'Admin\ApiController@getTopicsData')->name('topics.data');
	Route::get('api/posts', 'Admin\ApiController@getPostsData')->name('posts.data');
	Route::get('api/tags', 'Admin\ApiController@getTagsData')->name('tags.data');
	Route::get('api/users', 'Admin\ApiController@getUsersData')->name('users.data');
});

// Topics
Route::get('topics', 'TopicController@index')->name('topics');
Route::get('topic/{slug}', 'TopicController@show');

// Posts
Route::resource('posts', 'PostController', ['only' => ['store', 'update', 'destroy']]);
Route::group(['middleware' => 'login'], function () {
	Route::get('new-post', 'PostController@create')->name('posts.create');
	Route::get('{id}/edit', 'PostController@edit')->name('posts.edit');
});
Route::get('@{author}/{slug}', 'PostController@show')->name('posts.show');

// Profile
Route::get('@{username}', 'ProfileController@profile');
Route::get('@{username}/users/following', 'ProfileController@following')->name('following');
Route::get('@{username}/users/followers', 'ProfileController@followers')->name('followers');

// Me
Route::group(['prefix' => 'me'], function () {
	Route::group(['prefix' => 'posts'], function () {
		Route::get('drafts', 'UserController@draftPost')->name('drafts');
		Route::get('public', 'UserController@publicPost')->name('public');
	});
});

// Bookmarks
Route::get('browse/bookmarks', 'BookmarkController@index')->name('bookmark');
Route::post('bookmark/{bookmark}/{id}', 'BookmarkController@store');
Route::post('unbookmark/{id}', 'BookmarkController@destroy');

// Likes
Route::post('like/{like}/{id}', 'LikeController@store');
Route::post('unlike/{id}', 'LikeController@destroy');

// Comment
Route::post('post/comment', 'CommentController@store');
Route::get('{post}/comments', 'CommentController@data');

// Followable
Route::post('attach/{object}/{id}', 'FollowableController@attach');
Route::post('detach/{object}/{id}', 'FollowableController@detach');

// Mark notification as read
Route::get('mark-as-read/{id}','NotificationController@markAsRead');
Route::get('mark-all-as-read', function () {
	auth()->user()->unreadNotifications->markAsRead();
});

// Tags
Route::get('tag/{slug}', 'TagController@show')->name('tag.show');
Route::get('tag/{slug}/latest', 'TagController@latest')->name('tag.latest');
Route::get('search-tags', 'TagController@search');

// Search
Route::get('search', 'SearchController@search')->name('search');
Route::get('autocomplete', 'SearchController@autocomplete');

















// Pages
Route::get('popular', 'PageController@postsPopular')->name('posts.popular');
Route::get('recommendation', 'PageController@postsRecommendation')->name('posts.recommendation');
Route::get('followers', 'PageController@postsFollowers')->name('posts.followers');








Auth::routes();

