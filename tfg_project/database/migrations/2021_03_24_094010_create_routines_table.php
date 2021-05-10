<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routines', function (Blueprint $table) {
            $table->id();

            $table->string('name')->unique();
            $table->text('description');
            $table->string('image')->nullable();

            //Referencia a table routine types
            $table->unsignedBigInteger('routine_type_id');
            $table->foreign('routine_type_id')
                ->references('id')
                ->on('routines_types')
                ->onDelete('CASCADE');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('routines');
    }
}
