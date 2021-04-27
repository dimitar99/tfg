<?php

namespace App\Http\Controllers;

use App\Models\RoutineType;
use App\Http\Controllers\Controller;
use App\Http\Forms\RoutineTypeForm;
use App\Http\Requests\CreateRoutineTypeRequest;
use App\Http\Requests\UpdateRoutineTypeRequest;

class RoutineTypesController extends Controller
{
    /*
    * Devuelve el listado de tipos de rutinas paginado
    */

    public function list()
    {
        $routineTypes = RoutineType::paginate(10);

        return view('routineTypes.list', compact('routineTypes'));
    }

    /*
    * Muestra el detalle de un tipo de rutina
    */

    public function show($id)
    {
        $routineType = RoutineType::findOrFail($id);

        return view('routineTypes.show', compact('routineType'));
    }

    /*
    * Crear un tipo de rutina
    */

    public function create()
    {
        return new RoutineTypeForm('modals.create_routine_type', new RoutineType);
    }

    public function store(CreateRoutineTypeRequest $request)
    {
        $routineType = new RoutineType([
            'name' => $request->name
        ]);

        $routineType->save();

        return redirect()->route('routineTypes.list');
    }

    /*
    * Editar un tipo de rutina
    */

    public function edit($id)
    {
        $routineType = RoutineType::findOrFail($id);

        return new RoutineTypeForm('routineTypes.edit', $routineType);
    }

    /*
    * Actualiza una rutina
    */

    public function update(UpdateRoutineTypeRequest $request, RoutineType $routineType)
    {
        $routineType->fill([
            'name' => $request->name
        ]);

        $routineType->update();

        return redirect()->route('routineTypes.show', ['id' => $routineType->id]);
    }

    /*
    * Elimina una rutina
    */

    public function destroy(RoutineType $routineType)
    {
        $routineType->forceDelete();

        return redirect()->route('routineTypes.list');
    }
}
