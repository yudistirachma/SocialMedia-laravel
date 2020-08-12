<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // protected $guarded = [];
    protected $fillable = ['title', 'slug', 'body', 'category_id'];

    //model binding
    public function getRouteKey()
    {
        return 'slug';
    }
    // relasi one to many
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    // relasi many to many
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }
}
