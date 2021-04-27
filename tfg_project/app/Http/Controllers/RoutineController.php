<?php

namespace App\Http\Controllers;

use App\Http\Forms\RoutineForm;
use App\Http\Requests\CreateRoutineRequest;
use App\Http\Requests\UpdateRoutineRequest;
use App\Models\Routine;
use App\Models\RoutinesType;
use App\Models\RoutineType;

class RoutineController extends Controller
{

    /*
    * Devuelve el listado de rutinas paginado
    */

    public function list()
    {
        $routines = Routine::paginate(10);
        $routineTypes = RoutineType::all();

        return view('routines.list', compact('routines', 'routineTypes'));
    }

    /*
    * Muestra el detalle de una rutina
    */

    public function show($id)
    {
        $routine = Routine::findOrFail($id);

        return view('routines.show', compact('routine'));
    }

    /*
    * Crear una rutina
    */

    public function create()
    {
        return new RoutineForm('modals.create_routine', new Routine);
    }

    public function store(CreateRoutineRequest $request)
    {
        $routine = new Routine([
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description,
            'image' => $request->image,
        ]);

        $routine->save();

        return redirect()->route('routines.list');
    }

    /*
    * Editar una rutina
    */

    public function edit($id)
    {
        $routine = Routine::findOrFail($id);

        return new RoutineForm('routines.edit', $routine);
    }

    /*
    * Actualiza una rutina
    */

    public function update(UpdateRoutineRequest $request, Routine $routine)
    {
        $routine->fill([
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description,
            'image' => $request->image
        ]);

        $routine->save();

        return redirect()->route('routines.show', ['id' => $routine->id]);
    }

    /*
    * Elimina una rutina
    */

    public function destroy(Routine $routine)
    {
        $routine->forceDelete();

        return redirect()->route('routines.list');
    }
}
