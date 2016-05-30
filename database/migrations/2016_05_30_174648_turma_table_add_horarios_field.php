<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TurmaTableAddHorariosField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('turmas', function(Blueprint $table) {
            $table->date('data_inicio')->nullable();
            $table->date('data_fim')->nullable();
            $table->integer('carga_horaria')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('turmas', function(Blueprint $table) {
            $table->dropColumn('data_inicio');
            $table->dropColumn('data_fim');
            $table->dropColumn('carga_horaria');
        });
    }
}
