<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // protected $guarded = [];
    protected $fillable = ['title', 'slug', 'body', 'category_id', 'thumbnail'];

    //model binding
    public function getRouteKey()
    {
        return 'slug';
    }
    // relasi many to one
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    // relasi many to many
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // show image 
    public function takeImage()
    {
        return "storage/" . $this->thumbnail;
    }
}
