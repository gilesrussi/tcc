<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveHorarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('horario_turma');
        Schema::drop('horarios');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dia');
            $table->string('hora');
        });
        Schema::create('horario_turma', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('turma_id')->unsigned();
            $table->integer('horario_id')->unsigned();

            $table->foreign('turma_id')
                ->references('id')->on('turmas')
                ->onDelete('cascade');

            $table->foreign('horario_id')
                ->references('id')->on('horarios')
                ->onDelete('cascade');
        });

    }
}
