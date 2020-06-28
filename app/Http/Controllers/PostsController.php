<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Str;
class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        //$posts = Post::whereId(4)->get();
        //return view('posts.index', compact('posts'));
        $total = 250 * 1000;
        return view('posts.index',
        ['posts' => $posts,
        'tes' => 'tes',
        'total' => 'tes',
        ]);
    }
    public function create()
{
    return view('posts.create');
}

public function store(Request $request)
    {
        $tampil = "isi";
        $post = Post::create([
            'title'     => $request->input('title'),
            'slug'      => Str::slug($request->input('title')),
            'content'   => $request->input('content')
        ]);


        return redirect(route('posts.index'));
    }
      public function edit(Request $request, Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {

        $post = Post::whereId($post->id)->update([
            'title'     => $request->input('title'),
            'slug'      => Str::slug($request->input('title')),
            'content'   => $request->input('content')
        ]);


        return redirect(route('posts.index'));
    }


    public function destroy($id)
{
    $post = Post::find($id);
    $post->delete();

    return redirect(route('posts.index'));
}
}
