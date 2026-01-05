<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    use HasFactory;

    /**
     * guarded
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * post
     *
     * @return void
     */
    public function getImageAttribute($image)
    {
        return asset('storage/post_categories/'.$image);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
