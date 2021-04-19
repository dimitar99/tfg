<?php

namespace App\Http\Resources;

use App\Models\Post;
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
            'followers' => $this->followers->count(),
            'followed' => $this->followed->count(),
            'created_at' => $this->created_at->format('Y-m-d'),
            'posts' => Post::where('user_id', $this->id)->get()
        ];
    }
}
