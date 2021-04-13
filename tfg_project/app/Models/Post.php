<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'body'
    ];

    public static function createPost()
    {

    }

    public static function updatePost()
    {

    }

    public static function deletePost()
    {

    }

}
