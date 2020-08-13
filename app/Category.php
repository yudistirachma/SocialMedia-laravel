<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // protected $table = 'categories';
    protected $fillable = ['name', 'slug'];

    // relasi one to many
    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id');
    }
}
