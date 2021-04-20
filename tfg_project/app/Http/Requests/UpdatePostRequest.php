<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class UpdatePostRequest extends FormRequest
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
            'body' => ['required', 'string', 'max:100s']
        ];
    }

    public function messages()
    {
        return [];
    }

    public function updatePost(Post $post)
    {
        $post->fill([
            'body' => $this->body
        ]);

        if ($this->image) {
            $post->image = 'posts/image_' . $post->id . '.' . $this->image->getClientOriginalExtension();

            if (Storage::exists($post->image)) {
                Storage::delete($post->image);
            }

            Storage::put($post->image, file_get_contents($this->image));
        }

        return $post->update();
    }
}
