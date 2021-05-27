<?php

namespace App\Http\Controllers\CMSApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRoutineRequest;
use App\Http\Requests\UpdateRoutineRequest;
use App\Http\Resources\RoutineResource;
use App\Models\Routine;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class RoutineController extends Controller
{
    public function index()
    {
        $routines = Routine::orderBy('created_at', 'desc')->paginate(8);
        // dd($routines);
        return RoutineResource::collection($routines);
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
            Storage::put($path, file_get_contents($request->image));
            $routine->update(['image' => $path]);
        }
    }

    public function update(UpdateRoutineRequest $request, Routine $routine)
    {
        $routine->fill([
            'name' => $request->name,
            'type' => $request->type,
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
    }

    public function destroy(Routine $routine)
    {
        if (Storage::exists($routine->getOriginal('image'))) {
            Storage::delete($routine->getOriginal('image'));
        }

        $routine->forceDelete();
    }
}
