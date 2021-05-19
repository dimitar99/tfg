<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'image' => $this->id,
            'body' => $this->body,
            'user_id' => $this->user_id,
            'nick' => User::find($this->user_id)->nick,
            'created_at' => $this->created_at->format('Y-m-d'),
            'likes' => $this->likes()->count(),
            'liked_by_user' => ($this->likes()->where('id', $request->user()->id)->first()) ? 1 : 0,
            'categories' => $this->categories()->get()->toArray()
        ];
    }
}
