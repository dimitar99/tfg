<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoutineType extends Model
{
    use HasFactory;

    protected $table = "routines_types";

    protected $fillable = [
        'name'
    ];
}
