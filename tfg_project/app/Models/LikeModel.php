<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class LikeModel extends Pivot
{
    protected $table = 'likes';

    protected $fillable = [
        'user_id',
        'post_id'
    ];
}
