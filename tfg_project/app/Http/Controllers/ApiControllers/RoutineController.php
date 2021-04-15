<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoutineResource;
use App\Models\Routine;

class RoutineController extends Controller
{
    /*
    * Devuelve todas las rutinas
    */

    public function index()
    {
        $routines = Routine::paginate(15);

        return RoutineResource::collection($routines);
    }

    public function indexByType($type)
    {
        $routines = Routine::where('type', '=', $type)->paginate(15);

        return RoutineResource::collection($routines);
    }
}
