<?php

namespace App\Http\Controllers;

use App\Http\Forms\RoutineForm;
use App\Http\Requests\CreateRoutineRequest;
use App\Http\Requests\UpdateRoutineRequest;
use App\Models\Routine;
use App\Models\RoutinesType;

class RoutineController extends Controller
{

    /*
    * Devuelve el listado de rutinas paginado
    */

    public function index()
    {
        $routines = Routine::paginate(10);

        return view('routines.index', compact('routines'));
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
        return new RoutineForm('routines.create', new Routine);
    }

    public function store(CreateRoutineRequest $request)
    {
        $request->createRoutine();

        return redirect()->route('routines.index');
    }

    /*
    * Editar una rutina
    */

    public function edit($id)
    {
        $routine = Routine::findOrFail($id);

        //$routineTypes = RoutinesType::all();

        return new RoutineForm('routines.edit', $routine);
    }

    /*
    * Actualiza una rutina
    */

    public function update(UpdateRoutineRequest $request, Routine $routine)
    {
        $request->updateRoutine($routine);

        return redirect()->route('routines.show', ['id' => $routine->id]);
    }

    /*
    * Elimina una rutina
    */

    public function destroy(Routine $routine)
    {
        $routine->forceDelete();

        return redirect()->route('routines.index');
    }
}
