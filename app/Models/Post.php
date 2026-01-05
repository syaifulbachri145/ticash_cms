<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function category()
    {
        return $this->belongsTo(PostCategory::class);
    }


     /**
     * getImageAttribute
     *
     * @param  mixed $image
     * @return void
     */
    public function getImageAttribute($image)
    {
        return asset('storage/posts/' . $image);
    }

    public function getCreatedAtAttribute($date)
    {   
        return Carbon::parse($date)->format('d-M-Y');
    }
}
