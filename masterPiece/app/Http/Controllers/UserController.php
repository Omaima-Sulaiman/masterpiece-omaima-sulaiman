<?php

namespace App\Http\Controllers;

use App\Modle\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        $user = Post::findOrFail($user_id);

       
            // $allPosts = Post::all();
            //  dd($user->id);
            return view('users.index',compact('user'));

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
//        dd($request);
//        as console log
        $user_id=Auth::id();
//        auth take the user id dirctly with out reletionship betwwen tables
//        made vareablee to sored userid
        Post::create([
            'post'=>$request->input('task'),'user_id'=>$user_id
        ]);
        return $this->index();
//        return redirect()->route('tasks.index');

//        return view('tasks.index');
//        we cant use this way return view('tasks.index')
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

//
 }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $task=Task::findOrFail($id);
        return view('tasks.edit',compact('task'));
//        return redirect()->route('tasks.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $post =Post::findOrFail($id);
        $post->update([
            'title'=>$request->input('title'),
            'post_text'=>$request->input('post_text'),
            'city'=>$request->input('city'),


        ]);
//        dd($request);
        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

//        $tasks=Task::where ('id',$id)->delete();
//        $tasks=$this->destroy($id);
          Post::destroy($id);
        return redirect()->route('posts.index');
    }
}
