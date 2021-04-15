<?php

namespace App\Http\Forms;

use App\Models\Routine;
use Illuminate\Contracts\Support\Responsable;

class RoutineForm implements Responsable
{
    private $view;
    private $user;

    public function __construct($view, Routine $routine)
    {
        $this->view = $view;
        $this->routine = $routine;
    }

    public function toResponse($request)
    {
        return view($this->view, [
                'routine' => $this->routine,
            ]);
    }
}
