<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAtividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atividades', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tipo_atividade_id')->unsigned();
            $table->integer('turma_id')->unsigned();
            $table->text('descricao');
            $table->timestamp('data');
            $table->integer('valor');
            $table->timestamps();

            $table->foreign('turma_id')
                ->references('id')->on('turmas')
                ->onDelete('cascade');

            $table->foreign('tipo_atividade_id')
                ->references('id')->on('tipo_atividades')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('atividades');
    }
}
