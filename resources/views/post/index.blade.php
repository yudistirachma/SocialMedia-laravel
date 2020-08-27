@extends('layout.app')
@section('title', 'All Posts')
@section('content')
<div class="container">
    <div class="d-flex">
        <div>
            @if (isset($category))
                <h4>Category : {{$category->name}}</h4>
            @elseif (isset($tag))
                <h4>#Tag : {{$tag->name}}</h4>
            @else
                 <h4>All Posts</h4>
            @endif
            <hr>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            @forelse ($posts as $post) 
                <div class="card mb-4">
                    {{-- <img src="{{asset("storage/". $post->thumbnail)}}" class="card-img-top" alt=""> --}}
                    <a href="{{route('post.show', $post->slug)}}">
                        <img style="height: 400px; object-position: center; object-fit: cover" src="{{asset($post->takeImage())}}" class="card-img-top">
                    </a>
                    <div class="card-body">
                        <div>
                            <a href="{{route('categories.show', $post->category->slug)}}" class="text-secondary">
                                <small>
                                    {{$post->category->name}}
                                </small>
                            </a> &middot;

                            @foreach ($post->tags as $tag)
                                <a href="{{route('tags.show', $tag->slug)}}" class="text-secondary">
                                <small>
                                    {{$tag->name}}, 
                                </small>
                            </a>
                            @endforeach
                        </div>
                        <a href="{{route('post.show', $post->slug)}}" class="card-title">
                            <h5 class="text-dark">
                                {{$post->title}}
                            </h5>
                        </a>
                        <div class="text-secondary my-3">
                            {{Str::limit($post->body, 130) }}
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <div class="media align-items-center">
                                <img width="40" class="rounded-circle mr-2" src="{{$post->user->gravatar()}}" alt="">
                                <div class="media-body">
                                    <div>
                                        {{$post->user->name}}
                                    </div>
                                </div>
                            </div>
                            <div class="text-secondary">
                                <small>
                                    Published on : {{$post->created_at->diffForHumans()}}
                                </small>
                            </div>
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
        <div class="col-md-1"></div>
    </div>
    <div class="d-flex justify-content-center">
        {{$posts->links()}}
    </div>
</div>
@endsection