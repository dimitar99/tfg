<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Routine extends Model
{
    protected $table = 'routines';

    protected $fillable = [
        'name',
        'type',
        'description',
        'video'
    ];

    public function routineType()
    {
        return $this->belongsTo(RoutinesType::class);
    }
}
