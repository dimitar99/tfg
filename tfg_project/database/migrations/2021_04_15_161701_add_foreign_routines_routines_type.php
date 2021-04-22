<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignRoutinesRoutinesType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('routines', function (Blueprint $table) {
            $table->unsignedBigInteger('type')->nullable();
            $table->foreign('type')
                ->references('id')
                ->on('routines_types')
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
        Schema::table('routines', function (Blueprint $table) {
            $table->dropForeign('type');
            $table->dropColumn('type');
        });
    }
}
