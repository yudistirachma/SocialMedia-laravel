<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\{Post, Tag, Category};
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function show(Post $post)
    {
        // dd($post->tags);
        return view('post.show', compact('post'));
    }
    public function index()
    {
        $posts =  Post::orderBy('edited_at', 'desc')->paginate(6);
        return view('post.index', compact('posts'));
    }
    public function create()
    {
        return view('post.create', [
            'post' => new Post(),
            'tags' => Tag::get(),
            'categories' => Category::get()
        ]);
    }
    public function store(PostRequest $request)
    {
        // $attr = request()->validate([
        //     'title' => 'required|min:3|max:50|unique:posts',
        //     'body' => 'required|min:3'
        // ]);

        $attr  = $request->all();
        $attr["slug"] = Str::slug($request->title);
        $attr["category_id"] = $request->category;

        $post = Post::create($attr);
        $post->tags()->attach($request->tags);

        session()->flash('success', 'The content was created');
        // return back();
        return redirect('/post');
    }
    public function edit(Post $post)
    {
        foreach ($post->tags as $tag) {
            $cek[] = $tag->id;
        }

        // di buat untuk menangani masalah pada data yang lama 
        if (!isset($cek)) {
            $cek[] = "";
        }

        return view('post/edit', [
            'post' => $post,
            'tags' => Tag::get(),
            'categories' => Category::get(),
            'cek' => $cek
        ]);
    }
    public function update(Post $post)
    {
        if ($post->title == request()->title) {
            $attr = request()->validate([
                'title' => 'required|min:3|max:50',
                'body' => 'required|min:3',
                'category' => 'required',
                'tags' => 'array|required'
            ]);
        } else {
            $attr = request()->validate([
                'title' => 'required|min:3|max:50|unique:posts',
                'body' => 'required|min:3',
                'category' => 'required',
                'tags' => 'array|required'
            ]);
        }

        $attr['category_id'] = request()->category;
        $post->update($attr);
        $post->tags()->sync(request()->tags);

        session()->flash('success', 'The content was updated');

        return redirect('/post');
    }
    public function destroy(Post $post)
    {
        // dd($post);
        $post->tags()->detach();
        $post->delete();

        session()->flash('success', 'The content was deleted');
        return redirect('/post');
    }
}
