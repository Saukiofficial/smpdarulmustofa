<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::where('status', 'published')->latest()->paginate(9);
        return view('pages.frontend.posts.index', compact('posts'));
    }


    public function show(Post $post)
    {

        if ($post->status !== 'published') {
            abort(404);
        }


        $latestPosts = Post::where('status', 'published')
                            ->where('id', '!=', $post->id)
                            ->latest()
                            ->take(5)
                            ->get();

        return view('pages.frontend.posts.show', compact('post', 'latestPosts'));
    }
}
