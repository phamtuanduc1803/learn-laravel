<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

    /**
     * Get all of the post )     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function post()
    {
        return $this->hasMany(Post::class);
    }
}
