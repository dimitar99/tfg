<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /*
    * Crear un comentario
    */

    public function create(CreateCommentRequest $request)
    {
        $comment = new Comment([
            'post_id' => $request->post_id,
            'user_id' => $request->user()->id,
            'body' => $request->body
        ]);

        if ($comment->save()){
            return response()->json([
                'message' => trans('tfg.api.responses.comment_created')
            ], 200);
        }
        return response()->json([
            'message' => trans('tfg.api.responses.comment_not_created')
        ], 400);
    }

    /*
    * Actualizar un comentario
    */

    public function update(UpdateCommentRequest $request, $id)
    {
        $currentUser = $request->user();
        $comment = $currentUser->comments()->findOrFail($id);

        $comment->fill([
            'body' => $request->body
        ]);

        if ($comment->update()){
            return response()->json([
                'message' => trans('tfg.api.responses.comment_updated')
            ], 200);
        }
        return response()->json([
            'message' => trans('tfg.api.responses.comment_not_updated')
        ], 400);
    }

    /*
    * Eliminar un comentario
    */

    public function destroy(Request $request, $id)
    {
        $currentUser = $request->user();
        $comment = $currentUser->comments()->findOrFail($id);

        if ($comment->forceDelete()){
            return response()->json([
                'message' => trans('tfg.api.responses.comment_deleted')
            ], 200);
        }
        return response()->json([
            'message' => trans('tfg.api.responses.comment_not_deleted')
        ], 400);
    }
}
