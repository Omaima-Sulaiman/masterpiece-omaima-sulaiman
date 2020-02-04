<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Http\Requests\StorePostRequest;
use App\Tag;
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
            ->when(request('category_id'), function ($query) {
                return $query->whereHas('categories', function ($q) {
                    return $q->where('id', request('category_id'));
                });
            })
            ->when(request('tag_id'), function ($query) {
                return $query->whereHas('tags', function ($q) {
                    return $q->where('id', request('tag_id'));
                });
            })
            ->when(request('query'), function ($query) {
                return $query->where('title', 'like', '%' . request('query') . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(3);
        $all_categories = Category::all();
        $all_tags = Tag::all();
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
        $post = new Post();
        $post->title = $request->title;
        // $post->categories = $request->categories;
        $post->type = $request->type;
        $post->user_id =  auth()->user()->id;
        $post->post_text = $request->post_text;
        $post->city = $request->city;

        // Handle File Upload
        if ($request->hasFile('image')) {
            // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $post->image = $fileNameToStore;

        $post->save();


        if (isset($request->categories)) {
            $post->categories()->attach($request->categories);
        }

        if ($request->tags != '') {
            $tags = explode(',', $request->tags);
            foreach ($tags as $tag_name) {
                $tag = Tag::firstOrCreate(['name' => $tag_name]);
                $article->tags()->attach($tag);
            }
        }


        return redirect()->route('posts.index');
    }



    /////////////////////////////////////////////////////
    // public function store(Request $request)
    // {
    //     $this->validate($request, [
    //         'title' => 'required',
    //         'body' => 'required',
    //         'cover_image' => 'image|nullable|max:1999'
    //     ]);



    //     // Create Post
    //     $post = new Post;
    //     $post->title = $request->input('title');
    //     $post->body = $request->input('body');
    //     $post->user_id = auth()->user()->id;
    //     $post->save();

    //     return redirect('/posts')->with('success', 'Post Created');
    // }

    /////////////////////////////////////////////////////

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
        $comment = $post->comment()->with('user')->get();
        return view('posts.show', compact('post', 'all_categories', 'comment'));
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
    public function destroy($id)
    {
        Post::destroy($id);
        return redirect()->route('users.index');
    }
}
