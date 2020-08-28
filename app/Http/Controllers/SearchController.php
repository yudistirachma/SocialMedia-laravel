<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function post()
    {
        $search = request('search');
        $posts = Post::where("title", "like", "%$search%")->latest()->paginate(10);
        return view('post.index', compact('posts', 'search'));
    }
}
