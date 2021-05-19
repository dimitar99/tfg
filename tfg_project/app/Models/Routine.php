<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Routine extends Model
{
    protected $table = 'routines';

    protected $fillable = [
        'name',
        'type',
        'description',
        'image'
    ];

    public function getImageAttribute($value)
    {
        return $value ? Storage::url($value) : asset('/assets/images/big/img1.jpg');
    }

    public function routineType()
    {
        return $this->belongsTo(RoutineType::class, 'routine_type_id');
    }

    public function scopeType($query, $routine_type_id)
    {
        if ($routine_type_id){
            return $query->where('routine_type_id', '=', $routine_type_id);
        }
    }
}
