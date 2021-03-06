<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'body',
        'image',
        'user_id',
        'imageApi',
    ];

    public function getImageAttribute($value)
    {
        return $value ? Storage::url($value) : asset('/assets/images/big/img1.jpg');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_category');
    }

}
