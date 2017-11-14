<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $categories = \App\Category::orderBy('name', 'ASC')->get();
        view()->share(compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */    
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Http\Requests\PostRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostRequest $request)
    {
        $post = new Post;

        $post->user_id = auth()->id();
        $post->topic_id = $request->topic_id;
        $post->title = $request->title;
        $post->slug = str_slug($request->title);
        $post->body = $request->body;

        if ($request->publish) {
            $post->status = 1;
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName  = time() . '_' . str_random(9) . '.' . $image->getClientOriginalExtension();
            $location = public_path('storage/posts/' . $fileName);
            \Image::make($image)->save($location);
            $post->image = $fileName;
        }

        $post->save();
        echo $post->id;

        if ($request->tags) {
            $tagNames = explode(',', $request->tags);

            foreach ($tagNames as $tagName) {
                $tag = Tag::firstOrCreate([
                    'name' => $tagName,
                    'slug' => str_slug($tagName)
                ]);
                $tagIds[] = $tag->id;
            }

            $post->tags()->sync($tagIds);
        }

        if ($request->publish) {
            return redirect($post->path());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $author, $slug
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $author, $slug)
    {
        $post = Post::where('slug', $slug)->first();
        Post::where('id', $post->id)->increment('view');
        $randomPosts = Post::inRandomOrder()->where('id', '!=', $post->id)->take(3)->get();
        $comments = $post->comments()->orderBy('created_at', 'DESC')->paginate(5);
        $lastPage = $comments->lastPage();

        return view('posts.show', compact('post', 'randomPosts', 'comments', 'lastPage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $tags = $post->tags()->select('id', 'name')->get();
        return view('posts.edit', compact('post', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Http\Requests\PostRequest  $request
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::find($id);

        $post->topic_id = $request->topic_id;
        $post->title = $request->title;
        $post->slug = str_slug($request->title);
        $post->body = $request->body;

        if ($request->publish) {
            $post->status = 1;
        }

        if ($request->hasFile('image')) {
            if ($post->image != null) {
                if (file_exists($post->pathImage())) {
                    unlink($post->pathImage());
                }
            }

            $image = $request->file('image');
            $fileName  = time() . '_' . str_random(9) . '.' . $image->getClientOriginalExtension();
            $location = public_path('storage/posts/' . $fileName);
            \Image::make($image)->save($location);
            $post->image = $fileName;
        }
 
        $post->save();

        if ($request->tags) {
            $tagNames = explode(',', $request->tags);

            foreach ($tagNames as $tagName) {
                $tag = Tag::firstOrCreate([
                    'name' => $tagName,
                    'slug' => str_slug($tagName)
                ]);
                $tagIds[] = $tag->id;
            }

            $post->tags()->sync($tagIds);
        } else {
            $post->tags()->detach();
        }

        if ($request->publish) {
            return redirect($post->path());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if ($post->image != null) {
            if (file_exists($post->pathImage())) {
                unlink($post->pathImage());
            }
        }
        $post->delete($id);
        
        return back()->with('success', 'Deleted successfully.');
    }
}
