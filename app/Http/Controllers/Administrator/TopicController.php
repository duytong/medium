<?php

namespace App\Http\Controllers\Administrator;

use App\Topic;
use App\Http\Requests\\Http\Requests\TopicRequest;
use App\Http\Controllers\Controller;

class TopicController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administrator.topics.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrator.topics.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Http\Requests\TopicRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(\Http\Requests\TopicRequest $request)
    {   
        $topic = new Topic;

        $topic->category_id = request('category_id');
        $topic->name = request('name');
        $topic->slug = str_slug(request('name'));
        $topic->overview = request('overview');

        $image = $request->file('image');
        $extension = $image->getClientOriginalExtension();
        $filename = time() . '_' . str_random(9) . '.' . $extension;
        $location = public_path('storage/topics/' . $filename);
        \Image::make($image)->resize(280, 180)->save($location);
        $topic->image = $filename;

        $topic->save();

        return back()->with('success', 'Added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $topic = Topic::find($id);
        return view('administrator.topics.edit', compact('topic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Http\Requests\TopicRequest  $request
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(\Http\Requests\TopicRequest $request, $id)
    {
        $topic = Topic::find($id);

        $topic->category_id = request('category_id');
        $topic->name = request('name');
        $topic->slug = str_slug(request('name'));
        $topic->overview = request('overview');

        if ($request->hasFile('image')) {
            if (file_exists($topic->pathImage())) {
                unlink($topic->pathImage());
            }
            $image = $request->file('image');
            $extension = $avatar->getClientOriginalExtension();
            $filename = time() . '_' . str_random(9) . '.' . $extension;
            $location = public_path('storage/topics/' . $filename);
            \Image::make($image)->resize(280, 180)->save($location);
            $topic->image = $filename;
        }

        $topic->save();

        return back()->with('success', 'Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $topic = Topic::find($id);
        if (file_exists($topic->pathImage())) {
            unlink($topic->pathImage());
        }
        $topic->delete();
        
        return back()->with('success', 'Deleted successfully.');
    }
}
