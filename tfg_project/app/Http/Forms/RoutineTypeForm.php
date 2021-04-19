<?php

namespace App\Http\Forms;

use App\Models\RoutineType;
use Illuminate\Contracts\Support\Responsable;

class RoutineTypeForm implements Responsable
{
    private $view;
    private $routineType;

    public function __construct($view, RoutineType $routineType)
    {
        $this->view = $view;
        $this->routineType = $routineType;
    }

    public function toResponse($request)
    {
        return view($this->view, [
                'routineType' => $this->routineType,
            ]);
    }
}
