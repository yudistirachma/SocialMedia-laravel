<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $posts = $category->posts()->paginate(6);
        // dd($post);
        return view('post.index', compact('posts', 'category'));
    }
}
