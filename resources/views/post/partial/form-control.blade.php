<div class="form-group">
    <label for="title">Title</label>
    <input type="text" name="title" id="title" value=" {{ old('title') ?? $post->title}}" class="form-control @error('title') is-invalid @enderror">
    @error('title')
        <div class="invalid-feedback">
        {{$message}}
        </div>
    @enderror
</div>
<div class="form-group">
    <label for="category">Category</label>
    <select type="text" name="category" id="category" class="form-control @error('category') is-invalid @enderror ">
        <option disabled selected>Choose one</option>
        @foreach ($categories as $category)
            <option {{$category->id == $post->category_id ? 'selected' : '' }} value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
    </select>
    @error('category')
        <div class="invalid-feedback">
        {{$message}}
        </div>
    @enderror
</div>
<div class="form-group">
    <label for="tags">Tag</label>
    <select type="text" name="tags[]" id="tags" class="form-control select2 @error('tags') is-invalid @enderror " multiple>
        @foreach ($tags as $tag)
        @if (isset($cek))
            <option {{in_array($tag->id, $cek) ? 'selected' : '' }} value="{{$tag->id}}">{{$tag->name}}</option>
        @else
            <option value="{{$tag->id}}">{{$tag->name}}</option>
        @endif
        @endforeach
    </select>
    @error('tags')
        <div class="invalid-feedback">
        {{$message}}
        </div>
    @enderror
</div>
<div class="form-group">
    <label for="body">Body</label>
    <textarea type="text" name="body" id="body" class="form-control @error('body') is-invalid @enderror"> {{ old('body') ?? $post->body}}</textarea>
    @error('body')
        <div class="invalid-feedback">
        {{$message}}
        </div>
    @enderror
</div>
<button type="submit" class="btn btn-primary">{{$tombol ?? 'Update'}}</button>