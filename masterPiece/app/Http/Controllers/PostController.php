<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Http\Requests\StorePostRequest;
// use App\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with(['categories', 'author'])
            ->when(request('category_id'), function($query) {
                return $query->whereHas('categories', function($q) {
                    return $q->where('id', request('category_id'));
                });
            })
            // ->when(request('tag_id'), function($query) {
            //     return $query->whereHas('tags', function($q) {
            //         return $q->where('id', request('tag_id'));
            //     });
            // })
            ->when(request('query'), function($query) {
                return $query->where('title', 'like', '%'.request('query').'%');
            })
            ->orderBy('id', 'desc')
            ->paginate(3);
        $all_categories = Category::all();
        // $all_tags = Tag::all();
        return view('posts.index', compact('posts', 'all_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $post = Post::create($request->all() + ['user_id' => auth()->id()]);

        if (isset($request->categories)) {
            $post->categories()->attach($request->categories);
        }

        // if ($request->tags != '') {
        //     $tags = explode(',', $request->tags);
        //     foreach ($tags as $tag_name) {
        //         $tag = Tag::firstOrCreate(['name' => $tag_name]);
        //         $article->tags()->attach($tag);
        //     }
        // }

        if ($request->hasFile('image')) {
            $post->addMediaFromRequest('image')->toMediaCollection('images');
        }

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post->load(['categories',  'author']);
        $all_categories = Category::all();
        $all_tags = Tag::all();

        return view('posts.show', compact('post', 'all_categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $Post)
    {
        //
    }
}
