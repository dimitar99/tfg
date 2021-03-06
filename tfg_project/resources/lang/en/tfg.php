<?php

return [

    'home' => 'Home',
    'list' => 'List',
    'restore_pass' => 'Restore Password',
    'restore_info' => 'Enter your Email and instructions will be sent to you!',
    'activity_summary' => 'Activity Summary',
    'statistics' => 'Statistics',
    'posts_from_categories' => 'Posts of each category',
    'routines_from_types' => 'Routines of each type',

    'login' => [
        'sing_in' => 'Sing In',
        'email' => 'Email',
        'password' => 'Password',
        'password_confirmation' => 'Confirm Password',
        'remember_me' => 'Remember me',
        'forgot_pass' => 'Forgot password',
        'login' => 'Log in',
    ],

    'layouts' => [
        'header' => [
            'logout' => 'Logout',
            'language' => 'Language',
            'spanish' => 'Spanish',
            'english' => 'English',
        ],
        'body' => [
            'users' => 'Users',
            'posts' => 'Posts',
            'categories' => 'Categories',
            'routines' => 'Routines',
            'comments' => 'Comments',
            'routine-types' => 'Routine Types',
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
            'avatar_info' => 'If no photo is added, one will be added by default',
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
        'save' => 'Save',
        'update' => 'Update',
        'return' => 'Return',
        'return-to-list' => 'Return to list',
        'yes' => 'Yes',
        'no' => 'No',
        'cancel' => 'Cancel'
    ],

    'users' => [
        'title' => 'Users',
        'list' => 'Users Lists',
        'new' => 'New User',
        'create' => 'Create User',
        'edit' => 'Edit User',
        'detail' => 'User Detail',
    ],

    'posts' => [
        'title' => 'Posts',
        'list' => 'Posts List',
        'edit' => 'Edit Post',
        'detail' => 'Post Detail',
    ],

    'categories' => [
        'title' => 'Categories',
        'list' => 'Categories List',
        'new' => 'New Category',
        'create' => 'Create Category',
        'edit' => 'Edit Category',
        'detail' => 'Category Detail',
    ],

    'routines' => [
        'title' => 'Routines',
        'list' => 'Routines List',
        'new' => 'New Routine',
        'create' => 'Create Routine',
        'edit' => 'Edit Routine',
        'detail' => 'Routine Detail'
    ],

    'routines-types' => [
        'title' => 'Routine Types',
        'list' => 'Routine Types List',
        'new' => 'New Routine Type',
        'create' => 'Create Routine Type',
        'edit' => 'Edit Routine Type',
        'detail' => 'Routine Type Detail'
    ],

    'validations' => [
        'correct-the-errors' => 'Correct the errors',
        'image' => 'The file has to be an image'
    ],

    'api' => [
        'responses' => [
            'post_created' => 'Post created',
            'post_not_created' => 'Post not created',
            'post_updated' => 'Post updated',
            'post_not_updated' => 'Post not updated',
            'post_deleted' => 'Post deleted',
            'post_not_deleted' => 'Post not deleted',
            'post_liked' => 'Post like',
            'post_disliked' => 'Post dislike',
            'comment_created' => 'Comment created',
            'comment_not_created' => 'Comment not created',
            'comment_updated' => 'Comment updated',
            'comment_not_updated' => 'Comment not updated',
            'comment_deleted' => 'Comment deleted',
            'comment_not_deleted' => 'Comment not deleted',
            'user_unauthorized' => 'User authorized',
            'user_found' => 'User found',
            'user_not_found' => 'User not found',
            'user_updated' => 'User updated',
            'user_not_updated' => 'User not update',
            'user_follow' => 'User followed',
            'user_unfollow' => 'User not followed',
        ]
    ],

];
