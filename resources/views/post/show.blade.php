@extends('layout.app')
@section('title', $post->title)
@section('content')
    <div class="container">
        <h4>{{$post->title}}</h4>
        <div class="text-secondary">
            <a href="/category/{{$post->category->slug}}"> {{$post->category->name}}</a> 
            &middot; {{$post->created_at->format('d F, Y')}} 
            &middot;
            @foreach ($post->tags as $tag)
                <a href="/tags/{{$tag->slug}}">{{$tag->name}}</a>, 
            @endforeach
        </div>
        <hr>
        <p>
            {{$post->body}}
        </p>   
        <div>
            
            <!-- Button trigger modal -->
            @auth
                <button type="button" class="btn btn-link text-danger btn-sm p-0" data-toggle="modal" data-target="#exampleModal">
                    Delete
                </button>
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
            @endauth
            

            
        </div>
    </div>
@endsection