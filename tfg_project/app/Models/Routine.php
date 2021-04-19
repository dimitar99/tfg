<?php

namespace App\Models;

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
        return $this->belongsTo(RoutineType::class, 'type');
    }

    public function scopeType($query, $type)
    {
        if ($type){
            return $query->where('type', '=', $type);
        }
    }
}
