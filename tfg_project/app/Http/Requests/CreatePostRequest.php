<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CreatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'body' => ['required', 'string', 'max:100'],
            'image' => ['nullable']
        ];
    }

    public function messages()
    {
        return [
            'body.required' => 'El campo body no puede estar vacio'
        ];
    }

    public function createPost()
    {
        DB::transaction(function () {

            $post = new Post([
                'user_id' => $this->user()->id,
                'body' => $this->body
            ]);

            $post->save();

            if ($this->image) {
                $post->image = 'posts/image_' . $post->id . '.' . $this->image->getClientOriginalExtension();
                Storage::put($post->image, file_get_contents($this->image));

                $post->update();
            }

            return $post->save();
        });
    }
}
