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
        $comment = new Comment([
            'post_id' => $request->post_id,
            'user_id' => $request->user()->id,
            'body' => $request->body
        ]);

        if ($comment->save()){
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

        if ($currentUser) {
            if($comment){
                if ($comment != null){
                    $comment->fill([
                        'body' => $request->body
                    ]);

                    if ($comment->update()){
                        return response()->json([
                            'message' => 'Comentario actualizado correctamente'
                        ], 200);
                    }
                    return response()->json([
                        'message' => 'El comentario no ha sido actualizado'
                    ], 400);
                }else{
                    return response()->json([
                        'message' => 'Comentario no encontrado'
                    ], 400);
                }
            }else{
                return response()->json([
                    'message' => 'Comentario no encontrado'
                ], 400);
            }
        }else{
            return response()->json([
                'message' => 'Usuario no encontrado'
            ], 400);
        }
    }

    /*
    * Eliminar un comentario
    */

    public function destroy(Request $request, $id)
    {
        $currentUser = $request->user();
        $comment = $currentUser->comments()->findOrFail($id);

        if ($currentUser){
            if($comment){
                if ($comment != null){
                    if ($comment->forceDelete()){
                        return response()->json([
                            'message' => 'Comentario eliminado correctamente'
                        ], 200);
                    }
                    return response()->json([
                        'message' => 'El comentario no ha sido eliminado'
                    ], 400);
                }else{
                    return response()->json([
                        'message' => 'Comentario no encontrado'
                    ], 400);
                }
            }else{
                return response()->json([
                    'message' => 'Comentario no encontrado'
                ], 400);
            }
        }else{
            return response()->json([
                'message' => 'Usuario no encontrado'
            ], 400);
        }
    }
}
