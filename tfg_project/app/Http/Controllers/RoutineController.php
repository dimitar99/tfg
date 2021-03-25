<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoutineCreateRequest;
use App\Http\Requests\RoutineUpdateRequest;
use App\Http\Resources\RoutineResource;
use App\Models\Routine;
use Illuminate\Http\Request;

class RoutineController extends Controller
{
    
    /*
    * Devuelve el listado de usuarios paginado
    */

    public function index(){

        $routines = Routine::paginate(10);
        return RoutineResource::collection($routines);

    }

    /*
    * Crea una rutina
    */

    public function store(RoutineCreateRequest $request){
        
        $routine = Routine::create([
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description,
            'video' => $request->video
        ]);

        return response()->json([
            'mensaje' => 'Rutina creada correctamente'
        ], 200);

    }

    /*
    * Actualiza una rutina
    */

    public function update(RoutineUpdateRequest $request, Routine $routine){

        $routine = Routine::find($routine->id);

        $routine->name = $request->name;
        $routine->type = $request->type;
        $routine->description = $request->description;
        $routine->video = $request->video;

        if($routine->save()){
            return response()->json([
                'mensaje' => 'Rutina actualizada correctamente'
            ], 200);
        }

        return response()->json([
            'mensaje' => 'La actualizacion ha fallado'
        ], 400);

    }

    /*
    * Elimina una rutina
    */

    public function destroy(Routine $routine){

        $routine = Routine::find($routine->id);

        if($routine->delete()){
            return response()->json([
                'mensaje' => 'La rutina se ha borrado correctamente'
            ], 200);
        }

        return response()->json([
            'mensaje' => 'La eliminacion ha fallado'
        ], 400);

    }

}