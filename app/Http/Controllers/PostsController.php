<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller {
    public function __construct(){
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(2);
        return view('posts.index')->with('posts', $posts);
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
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',

            ]);
        if($request->hasFile('cover_image')){
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('cover_image')->storeAs('public/cover_images', $filenameToStore);
        }
        else{
            $filenameToStore = 'no_image.jpg';
        }

        if($request->hasFile('pdfdocs')){
            $filenameWithExt2 = $request->file('pdfdocs')->getClientOriginalName();
            $filename2 = pathinfo($filenameWithExt2, PATHINFO_FILENAME);
            $extension = $request->file('pdfdocs')->getClientOriginalExtension();
            $filenameToStore2 = $filename2.'_'.time().'.'.$extension;
            $path = $request->file('pdfdocs')->storeAs('public/pdfdocs', $filenameToStore2);
        }
        else{
            $filenameToStore2 = 'no_pdf.pdf';
        }

        $post = new Post();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->name = $request->input('name');
        $post->surname = $request->input('surname');
        $post->patronymic = $request->input('patronymic');
        $post->phnumber = $request->input('phnumber');
        $post->ppnumber = $request->input('ppnumber');
        $post->user_id = Auth::id();
        $post->cover_image = $filenameToStore;
        $post->pdfdocs = $filenameToStore2;
        $post->save();
        return redirect('posts')->with('success', 'Post successfully created');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show ($id)
    {
//
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        $post = Post::find($id);
        if(auth()->user()->id !== $post->user_id){
            return redirect('posts')->with('error', 'Access denied due to unauthorized User!');
        }
        return view('posts.edit')->with('post', $post);
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
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
            ]);
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();
        return redirect('posts')->with('success', 'Post successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(auth()->user()->id !== $post->user_id){
            return redirect('posts')->with('error', 'Access denied due to unauthorized User!');
        }
        $post->delete();
        return redirect('posts')->with('success', 'Post successfully deleted!!');
    }
}
