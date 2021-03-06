<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\{Post, Tag, Category, User};
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function show(Post $post)
    {
        $posts = Post::with('tags', 'category', 'user')->where('category_id', $post->category_id)->latest()->limit(5)->get();
        return view('post.show', compact('post', 'posts'));
    }
    public function index()
    {
        $posts =  Post::with('tags', 'category', 'user')->orderBy('edited_at', 'desc')->paginate(6);
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
        $attr  = $request->all();
        $slug = Str::slug($request->title);
        $attr["slug"] = $slug;


        $thumbnail = request()->file('thumbnail') ? request()->file('thumbnail')->store("images/posts") : null;

        $attr["category_id"] = request('category');
        $attr["thumbnail"] = $thumbnail;

        // create a new post
        // $post = Post::create($attr);
        $post = auth()->user()->posts()->create($attr);
        $post->tags()->attach($request->tags);

        session()->flash('success', 'The content was created');
        // return back();
        return redirect('/post');
    }
    public function edit(Post $post)
    {
        // authorize
        $this->authorize('update', $post);

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
        // authorize
        $this->authorize('update', $post);

        if ($post->title == request()->title) {
            $attr = request()->validate([
                'title' => 'required|min:3|max:50',
                'body' => 'required|min:3',
                'category' => 'required',
                'tags' => 'array|required',
                'thumbnail' => 'image|mimes:jpg,png,svg,jpeg|max:2048'
            ]);
        } else {
            $attr = request()->validate([
                'title' => 'required|min:3|max:50|unique:posts',
                'body' => 'required|min:3',
                'category' => 'required',
                'tags' => 'array|required',
                'thumbnail' => 'image|mimes:jpg,png,svg,jpeg|max:2048'
            ]);
        }

        if (request()->file('thumbnail')) {
            Storage::delete($post->thumbnail);
            $thumbnail = request()->file('thumbnail')->store("images/posts");
        } else {
            $thumbnail = $post->thumbnail;
        }

        $attr['category_id'] = request()->category;
        $attr['thumbnail'] = $thumbnail;

        $post->update($attr);
        $post->tags()->sync(request()->tags);

        session()->flash('success', 'The content was updated');
        return redirect('/post');
    }
    public function destroy(Post $post)
    {
        // cek auth user yang login
        if (auth()->id() != $post->user_id) {
            session()->flash('error', 'That is not your post');
            return redirect('/post');
        }

        // delete storage image in system
        Storage::delete($post->thumbnail);

        $post->tags()->detach();
        $post->delete();

        session()->flash('success', 'The content was deleted');
        return redirect('/post');
    }
}
