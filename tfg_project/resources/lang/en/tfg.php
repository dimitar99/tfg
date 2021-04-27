<?php

return [

    'layouts' => [
        'header' => [
            'users' => 'Users',
            'posts' => 'Posts',
            'categories' => 'Categories',
            'routines' => 'Routines',
            'routine-types' => 'Routine Types',
            'logout' => 'Logout',
            'language' => 'Language',
            'spanish' => 'Spanish',
            'english' => 'English',
        ]
    ],

    'tables' => [
        'id' => 'ID',
        'name' => 'NAME',
        'surnames' => 'SURNAMES',
        'nick' => 'NICK',
        'email' => 'EMAIL',
        'posts' => 'POSTS',
        'followed' => 'FOLLOWED',
        'followers' => 'FOLLOWERS',
        'comment-id' => 'COMMENT ID',
        'created-at' => 'CREATED AT',
        'actions' => 'ACTIONS',
        'user-id' => 'USER ID',
        'content' => 'CONTENT',
        'image' => 'IMAGE',
        'body' => 'BODY',
        'comments' => 'COMMENTS',
        'type' => 'TYPE',
        'description' => 'DESCRIPTION'
    ],

    'forms' => [
        'fields' => [
            'id' => 'Id',
            'name' => 'Name',
            'surnames' => 'Surnames',
            'nick' => 'Nick',
            'bio' => 'Biography',
            'email' => 'Email',
            'password' => 'Password',
            'password-confirmation' => 'Confirm Password',
            'num-posts' => 'Posts',
            'followers' => 'Followers',
            'followed' => 'Followed',
            'user-id' => 'User id',
            'post-id' => 'Post id',
            'body' => 'Body',
            'comments' => 'Comments',
            'type' => 'Type',
            'description' => 'Description',
            'image' => 'Image',
            'posts' => 'Posts',
            'creation-date' => 'Creacion date',
        ],
        'small' => [
            'avatar_info' => 'Only .jpg format',
            'nick_info' => 'It can contain numbers, maximum 15 characters',
            'bio_info' => 'Max 200 characters',
            'password_info' => 'Min 8 characters',
            'description-info' => 'Max 600 characters'
        ],
        'default' => [
            'select' => 'Select one type'
        ]
    ],

    'buttons' => [
        'show' => 'Show',
        'edit' => 'Edit',
        'delete' => 'Delete',
        'update' => 'Update',
        'return' => 'Return',
        'return-to-list' => 'Return to list',
        'yes' => 'Yes',
        'no' => 'No',
        'cancel' => 'Cancel'
    ],

    'users' => [
        'list' => 'Users Lists',
        'new' => 'New User',
        'create' => 'Create User',
        'detail' => 'User Detail',
    ],

    'posts' => [
        'list' => 'Posts List',
        'detail' => 'Post Detail',
    ],

    'categories' => [
        'list' => 'Categories List',
        'new' => 'New Category',
        'create' => 'Create Category',
        'detail' => 'Category Detail',
    ],

    'routines' => [
        'list' => 'Routines List',
        'new' => 'New Routine',
        'create' => 'Create Routine',
        'detail' => 'Routine Detail'
    ],

    'routines-types' => [
        'list' => 'Routines Type List',
        'new' => 'New Routine Type',
        'create' => 'Create Routine Type',
        'detail' => 'Routine Type Detail'
    ],

    'validations' => [
        'correct-the-errors' => 'Correct the errors',
    ],

];
