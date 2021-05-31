<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Resources\RoutineTypesResource;
use App\Models\RoutineType;
use App\Http\Controllers\Controller;

class RoutineTypesController extends Controller
{
    public function getTypes()
    {
        $types = RoutineType::get();

        return RoutineTypesResource::collection($types);
    }
}
