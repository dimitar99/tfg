c<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoutineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'description' => $this->description,
            'video' => $this->video,
            'created_at' => $this->created_at->format('Y-m-d'),
            'hola' => $this->routineType
        ];
    }
}
