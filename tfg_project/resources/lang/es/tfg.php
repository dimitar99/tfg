<?php

return [

    'home' => 'Inicio',
    'list' => 'Listado',
    'restore_pass' => 'Recuperar Contraseña',
    'restore_info' => 'Introduce tu Email y recibirás los pasos para restaurar la contraseña',
    'activity_summary' => 'Resumen de Actividad',
    'statistics' => 'Estadisticas',
    'posts_from_categories' => 'Posts de cada categoria',
    'routines_from_types' => 'Rutinas de cada tipo',

    'login' => [
        'sing_in' => 'Iniciar Sesión',
        'email' => 'Correo',
        'password' => 'Contraseña',
        'password_confirmation' => 'Confirma Contraseña',
        'remember_me' => 'Recuerdame',
        'forgot_pass' => 'Contraseña olvidada?',
        'login' => 'Acceder',
    ],

    'layouts' => [
        'header' => [
            'logout' => 'Cerrar Sesión',
            'language' => 'Idioma',
            'spanish' => 'Español',
            'english' => 'Ingles',
        ],
        'body' => [
            'users' => 'Usuarios',
            'posts' => 'Posts',
            'categories' => 'Categorias',
            'routines' => 'Rutinas',
            'comments' => 'Comentarios',
            'routine-types' => 'Tipos Rutinas',
        ],
    ],

    'tables' => [
        'id' => 'ID',
        'name' => 'NOMBRE',
        'surnames' => 'APELLIDOS',
        'nick' => 'NICK',
        'email' => 'EMAIL',
        'posts' => 'POSTS',
        'followed' => 'SEGUIDOS',
        'followers' => 'SEGUIDORES',
        'comment-id' => 'COMMENT ID',
        'created-at' => 'FECHA CREACION',
        'actions' => 'ACCIONES',
        'user-id' => 'USER ID',
        'content' => 'CONTENIDO',
        'image' => 'IMAGEN',
        'body' => 'BODY',
        'comments' => 'COMENTARIOS',
        'type' => 'TIPO',
        'description' => 'DESCRIPCION'
    ],

    'forms' => [
        'fields' => [
            'id' => 'Id',
            'name' => 'Nombre',
            'surnames' => 'Apellidos',
            'nick' => 'Nick',
            'bio' => 'Biografia',
            'email' => 'Email',
            'password' => 'Contraseña',
            'password-confirmation' => 'Confirmar Contraseña',
            'num-posts' => 'Posts',
            'followers' => 'Seguidores',
            'followed' => 'Seguidos',
            'user-id' => 'User id',
            'post-id' => 'Post id',
            'body' => 'Body',
            'comments' => 'Commentarios',
            'type' => 'Tipo',
            'description' => 'Descripcion',
            'image' => 'Imagen',
            'posts' => 'Posts',
            'creation-date' => 'Fecha Creacion',
        ],
        'small' => [
            'avatar_info' => 'Si no se añade una foto, se añadira una por defecto',
            'nick_info' => 'Puede contener numeros, maximo 15 caracteres',
            'bio_info' => 'Máximo 200 caracteres',
            'password_info' => 'Mínimo 8 carácteres',
            'description-info' => 'Máximo 600 caracteres'
        ],
        'default' => [
            'select' => 'Selecciona un tipo'
        ]
    ],

    'buttons' => [
        'show' => 'Ver',
        'edit' => 'Editar',
        'delete' => 'Eliminar',
        'update' => 'Actualizar',
        'return' => 'Volver',
        'return-to-list' => 'Regresar al listado',
        'yes' => 'Si',
        'no' => 'No',
        'cancel' => 'Cancelar'
    ],

    'users' => [
        'title' => 'Usuarios',
        'list' => 'Listado Usuarios',
        'new' => 'Nuevo Usuario',
        'create' => 'Crear usuario',
        'edit' => 'Editar Usuario',
        'detail' => 'Detalle de Usuario',
    ],

    'posts' => [
        'title' => 'Posts',
        'list' => 'Listado Posts',
        'edit' => 'Editar Post',
        'detail' => 'Detalle de Post',
    ],

    'categories' => [
        'title' => 'Categorias',
        'list' => 'Listado Categorias',
        'new' => 'Nueva Categoria',
        'create' => 'Crear Categoria',
        'edit' => 'Editar Categoria',
        'detail' => 'Detalle de Categoria',
    ],

    'routines' => [
        'title' => 'Rutinas',
        'list' => 'Listado Rutinas',
        'new' => 'Nueva Rutina',
        'create' => 'Crear Rutina',
        'edit' => 'Editar Rutina',
        'detail' => 'Detalle de Rutina'
    ],

    'routines-types' => [
        'title' => 'Tipos Rutinas',
        'list' => 'Listado Tipos Rutinas',
        'new' => 'Nuevo Tipo Rutina',
        'create' => 'Crear Tipo Rutina',
        'edit' => 'Editar Tipo Rutina',
        'detail' => 'Detalle de Tipo Rutina'
    ],

    'validations' => [
        'correct-the-errors' => 'Corrige los errores',
    ],

    'api' => [
        'responses' => [
            'post_created' => 'Post creado',
            'post_not_created' => 'Post no creado',
            'post_updated' => 'Post actualizado',
            'post_not_updated' => 'Post no actualizado',
            'post_deleted' => 'Post eliminado',
            'post_not_deleted' => 'Post no eliminado',
            'post_liked' => 'Like a post',
            'post_disliked' => 'Dislike a post',
            'comment_created' => 'Comentario creado',
            'comment_not_created' => 'Comentario no creado',
            'comment_updated' => 'Comentario actualizado',
            'comment_not_updated' => 'Comentario no actualizado',
            'comment_deleted' => 'Comentario eliminado',
            'comment_not_deleted' => 'Comentario no eliminado',
            'user_unauthorized' => 'Usuario no autorizado',
            'user_found' => 'Usuario encontrado',
            'user_not_found' => 'Usuario no encontrado',
            'user_updated' => 'Usuario actualizado',
            'user_not_updated' => 'Usuario no actualizado',
            'user_follow' => 'Usuario seguido',
            'user_unfollow' => 'Usuario no seguido',
        ]
    ],

];
