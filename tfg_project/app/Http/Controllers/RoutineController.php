<?php

namespace App\Http\Controllers;

use App\Http\Forms\RoutineForm;
use App\Http\Requests\CreateRoutineRequest;
use App\Http\Requests\UpdateRoutineRequest;
use App\Models\Routine;
use App\Models\RoutineType;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

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
        return new RoutineForm('routines.create', new Routine);
    }

    public function store(CreateRoutineRequest $request)
    {
        $routine = new Routine([
            'name' => $request->name,
            'routine_type_id' => $request->routine_type_id,
            'description' => $request->description,
        ]);

        $routine->save();

        if ($request->image) {
            $path = 'routines/image_' . $routine->id . '.' . $request->image->getClientOriginalExtension();

            if (Storage::exists($routine->getOriginal('image'))) {
                Storage::delete($routine->getOriginal('image'));
            }

            $image = Image::make($request->avatar)->encode('jpg', 90);
            $image->resize(null, 800, function ($constraint) {
                $constraint->aspectRatio();
            });

            Storage::put($path, (string)$image);

            $routine->update(['image' => $path]);
        }

        return redirect()->route('routines.list');
    }

    /*
    * Editar una rutina
    */

    public function edit($id)
    {
        $routine = Routine::findOrFail($id);
        $routineTypes = RoutineType::all();
        $image = "";

        if (Storage::exists($routine->getOriginal('image'))) {
            $image = Storage::url($routine->getOriginal('image'));
        }

        return view('routines.edit', compact('routine', 'routineTypes', 'image'));
    }

    /*
    * Actualiza una rutina
    */

    public function update(UpdateRoutineRequest $request, Routine $routine)
    {
        $routine->fill([
            'name' => $request->name,
            'routine_type_id' => $request->routine_type_id,
            'description' => $request->description
        ]);

        if ($request->image) {
            $path = 'routines/image_' . $routine->id . '.' . $request->image->getClientOriginalExtension();

            if (Storage::exists($routine->getOriginal('image'))) {
                Storage::delete($routine->getOriginal('image'));
            }

            $image = Image::make($request->avatar)->encode('jpg', 90);
            $image->resize(null, 800, function ($constraint) {
                $constraint->aspectRatio();
            });

            Storage::put($path, (string)$image);
            $routine->update(['image' => $path]);
        }else{
            //Si se elimina la imagen del form, la rutina se queda sin foto
            if (Storage::exists($routine->getOriginal('image'))) {
                Storage::delete($routine->getOriginal('image'));
            }
        }

        $routine->save();

        return redirect()->route('routines.show', ['id' => $routine->id]);
    }

    /*
    * Elimina una rutina
    */

    public function destroy(Routine $routine)
    {
        if (Storage::exists($routine->getOriginal('image'))) {
            Storage::delete($routine->getOriginal('image'));
        }

        $routine->forceDelete();

        return redirect()->route('routines.list');
    }
}
