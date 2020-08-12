<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // relasi many to many
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tag');
    }
}
