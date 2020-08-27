@extends('layout.app')
@section('title', $post->title)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mb-4">
                @if ($post->thumbnail)
                    <img style="height: 500px; object-position: center; object-fit: cover" src="{{asset($post->takeImage())}}" class="card-img-top w-100">

                @endif
                <h4 class="mt-3">{{$post->title}}</h4>
                <div class="text-secondary mb-3">
                    <a href="/category/{{$post->category->slug}}"> {{$post->category->name}}</a> 
                    &middot; {{$post->created_at->format('d F, Y')}} 
                    &middot;
                    @foreach ($post->tags as $tag)
                        <a href="/tags/{{$tag->slug}}">{{$tag->name}}</a>, 
                    @endforeach
                    <div class="media my-3">
                        {{-- Wrote by {{$post->user->name}} --}}
                        <img width="60" class="rounded-circle mr-3" src="{{$post->user->gravatar()}}" alt="">
                        <div class="media-body">
                            {{$post->user->name}}
                            <div>
                                {{'@'.$post->user->username}}
                            </div>
                        </div>
                    </div>
                </div>
                <p>
                    {!! nl2br($post->body) !!}
                </p>
                <div>
                    <!-- Button trigger modal -->
                    @if (auth()->user()->is($post->user))
                        <div class="flex mt-3">
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal">
                                Delete
                            </button>
                            <a href="/post/{{$post->id}}/edit" class="btn btn-sm btn-success">Edit</a>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Are you sure for delete ?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div>{{$post->title}}</div>
                                    <div>
                                        Publish on : {{$post->created_at->format('d F, Y')}}
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    
                                    <button type="button" class=" btn btn-primary btn-sm" data-dismiss="modal">Close</button>
                                    <form action="/post/{{$post->id}}" method="POST" class="p-0 m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <h4>Another Post</h4>
                <hr>
                @foreach ($posts as $post)
                    <div class="card mb-4">
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
                                {{Str::limit($post->body, 70) }}
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
                @endforeach
            </div>
        </div>
    </div>
@endsection