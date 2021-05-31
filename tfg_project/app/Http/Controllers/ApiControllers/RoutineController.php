<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoutineResource;
use App\Models\Routine;
use Illuminate\Http\Request;

class RoutineController extends Controller
{
    /*
    * Devuelve todas las rutinas
    */

    public function getRoutines(Request $request)
    {
        $routines = Routine::get();

        return response()->json([
            'routines' => RoutineResource::collection($routines)
        ]);
    }
}
