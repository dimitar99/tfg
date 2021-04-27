<?php

return [

    'layouts' => [
        'header' => [
            'users' => 'Usuarios',
            'posts' => 'Posts',
            'categories' => 'Categorias',
            'routines' => 'Rutinas',
            'routine-types' => 'Tipos Rutinas',
            'logout' => 'Cerrar Sesión',
            'language' => 'Idioma',
            'spanish' => 'Español',
            'english' => 'Ingles',
        ]
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
        'type' => 'TYPE',
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
            'avatar_info' => 'Solo formato .jpg',
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
        'list' => 'Listado Usuarios',
        'new' => 'Nuevo Usuario',
        'create' => 'Crear usuario',
        'detail' => 'Detalle de Usuario',
    ],

    'posts' => [
        'list' => 'Listado posts',
        'detail' => 'Detalle de Post',
    ],

    'categories' => [
        'list' => 'Listado Categorias',
        'new' => 'Nueva Categoria',
        'create' => 'Crear Categoria',
        'detail' => 'Detalle de Categoria',
    ],

    'routines' => [
        'list' => 'Listado Rutinas',
        'new' => 'Nueva Rutina',
        'create' => 'Crear Rutina',
        'detail' => 'Detalle de Rutina'
    ],

    'routines-types' => [
        'list' => 'Listado Tipos Rutinas',
        'new' => 'Nuevo Tipo Rutina',
        'create' => 'Crear Tipo Rutina',
        'detail' => 'Detalle de Tipo Rutina'
    ],

    'validations' => [
        'correct-the-errors' => 'Corrige los errores',
    ],

];
