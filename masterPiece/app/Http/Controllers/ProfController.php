<?php

namespace App\Http\Controllers;

use App\Prof;
use App\Post;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        $posts = Post::where('user_id',$user_id)
        ->get();
        
           
            //   dd($user);
            return view('users.index',compact('posts'));
       

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Prof  $prof
     * @return \Illuminate\Http\Response
     */
    public function show(Prof $prof)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Prof  $prof
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $post=Post::findOrFail($id);
        // dd($post);
        return view('users.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prof  $prof
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post =Post::findOrFail($id);
        $post->update([
            'title'=>$request->input('title'),
            'post_text'=>$request->input('post_text'),
            'image'=>$request->input('image'),
            'city'=>$request->input('city'),

        ]);
        // return $this->show($post);
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prof  $prof
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);
        return redirect()->route('users.index');
    }
}
