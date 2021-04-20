<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /*
    * Crear un comentario
    */

    public function create(CreateCommentRequest $request)
    {
        if ($request->createComment()){
            return response()->json([
                'message' => 'Comentario creado correctamente'
            ], 200);
        }
        return response()->json([
            'message' => 'El comentario no ha sido creado'
        ], 400);
    }

    /*
    * Actualizar un comentario
    */

    public function update(UpdateCommentRequest $request, $id)
    {
        $currentUser = $request->user();
        $comment = $currentUser->comments()->findOrFail($id);

        if ($request->updateComment($comment)){
            return response()->json([
                'message' => 'Comentario actualizado correctamente'
            ], 200);
        }
        return response()->json([
            'message' => 'El comentario no ha sido actualizado'
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
                'message' => 'Comentario eliminado correctamente'
            ], 200);
        }
        return response()->json([
            'message' => 'El comentario no ha sido eliminado'
        ], 400);
    }
}
