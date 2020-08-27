@extends('layout.app', ['title' => 'Update Post'])
@section('content')
<div class="container"> 
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Update Post</div>
                <div class="card-body">
                    <form action="/post/{{$post->id}}/edit" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        @include('post.partial.form-control')
                    </form>
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection