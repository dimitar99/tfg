<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        /*
            Especifica los atributos de User a devolver
        */
        return[
            'id' => $this->id,
            'name' => $this->name,
            'surnames' => $this->surnames,
            'nick' => $this->nick,
            'email' => $this->email,
            'created_at' => $this->created_at->format('Y-m-d')
        ];
    }
}
