@extends('layout.app', ['title' => 'New Post'])
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">New Post</div>
                <div class="card-body">
                    <form action="/post/store" method="post" enctype="multipart/form-data">
                        @csrf
                        @include('post.partial.form-control', ['tombol' => 'Create'])
                    </form>
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection