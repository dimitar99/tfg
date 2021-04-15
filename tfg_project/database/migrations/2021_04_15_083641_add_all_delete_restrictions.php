<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAllDeleteRestrictions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('posts', function (Blueprint $table) {
        /* $table->dropForeign(['user_id']);
            para cuando se va a modificar el nombre del campo
        */
        $table->dropForeign('posts_user_id_foreign');
        $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('CASCADE');
    });
    Schema::table('comments', function (Blueprint $table) {
        $table->dropForeign('comments_post_id_foreign');
        $table->foreign('post_id')->references('id')->on('posts')
            ->onDelete('CASCADE');
    });
    Schema::table('comments', function (Blueprint $table) {
        $table->dropForeign('comments_user_id_foreign');
        $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('CASCADE');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['posts_user_id_foreign']);
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['comments_post_id_foreign']);
            $table->foreign('post_id')->references('id')->on('posts');
        });
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['comments_user_id_foreign']);
            $table->foreign('user_id')->references('id')->on('users');
        });
    }
}
