<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursoInstituicaoDisciplinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curso_instituicao_disciplinas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('curso_id')->unsigned();
            $table->integer('instituicao_id')->unsigned();
            $table->integer('disciplina_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('curso_id')
                ->references('id')->on('cursos')
                ->onDelete('cascade');
            $table->foreign('instituicao_id')
                ->references('id')->on('instituicoes')
                ->onDelete('cascade');
            $table->foreign('disciplina_id')
                ->references('id')->on('disciplinas')
                ->onDelete('cascade');
            $table->unique(array('curso_id', 'disciplina_id', 'instituicao_id'), 'cdi_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('curso_instituicao_disciplinas');
    }
}
