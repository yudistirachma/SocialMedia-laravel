@extends('layout.app')
@section('title', 'All Posts')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        <div>
            @if (isset($category))
                <h4>Category : {{$category->name}}</h4>
            @elseif (isset($tag))
                <h4>Category : {{$tag->name}}</h4>
            @else
                 <h4>All Posts</h4>
            @endif
            <hr>
        </div>
        <div>
            @if (Auth::check())
                <a href="{{route('posts.create')}}" class="btn btn-primary">New Post</a>
            @else
                <a href="{{route('posts.create')}}" class="btn btn-primary">login for create post</a>
            @endif
        </div>
    </div>
    <div class="row">
        @forelse ($posts as $post) 
            <div class="col-md-4"> 
                <div class="card mb-3">
                    <div class="card-header">
                        {{$post->title}}
                    </div>
                    <div class="card-body">
                        <div>
                        {{Str::limit($post->body, 100) }}
                        </div>
                        <a href="/post/{{$post->slug}}">read more</a>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        Publish on : {{$post->created_at->diffForHumans()}}
                        @can('update', $post)                            
                            <a href="/post/{{$post->id}}/edit" class="btn btn-sm btn-success">Edit</a>
                        @endcan
                    </div>
                </div>
            </div>
            @empty
            <div class="container text-center">               
                <div class="alert alert-warning text-center alert-dismissible fade show" role="alert">
                There's NO Post !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>   
        @endforelse
    </div>
    <div class="d-flex justify-content-center">
        {{$posts->links()}}
    </div>
</div>
@endsection