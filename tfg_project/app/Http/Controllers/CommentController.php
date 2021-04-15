<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    /*
    * Enviar un comentario a la papelera
    */

    public function destroy(Comment $comment)
    {
        $post = Post::findOrFail($comment->post_id);

        $comment->forceDelete();

        return redirect()->route('posts.show', $post);
    }
}
