<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AulaTableAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aulas', function (Blueprint $table) {
            $table->date('dia');
            $table->time('horario_inicio');
            $table->time('horario_fim');
            $table->text('descricao')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('aulas', function (Blueprint $table) {
            $table->dropColumn('dia');
            $table->dropColumn('hora_inicio');
            $table->dropColumn('hora_fim');
            $table->dropColumn('descricao');
        });
    }
}
