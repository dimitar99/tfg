<?php

namespace App\Http\Controllers\CMSApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRoutineTypeRequest;
use App\Http\Requests\UpdateRoutineTypeRequest;
use App\Models\RoutineType;

class RoutineTypeController extends Controller
{
    public function index()
    {
        $routineTypes = RoutineType::orderBy('created_at', 'desc')->paginate(12);

        return $routineTypes;
    }

    public function store(CreateRoutineTypeRequest $request)
    {
        $routineType = new RoutineType([
            'name' => $request->name,
        ]);

        $routineType->save();
    }

    public function show()
    {
    }

    public function update(UpdateRoutineTypeRequest $request, RoutineType $routineType)
    {
        $routineType->update(['name' => $request->name]);
    }

    public function destroy(RoutineType $routineType)
    {
        $routineType->forceDelete();
    }
}
