<?php

use Illuminate\Database\Seeder;

class TurmaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\CursoInstituicaoDisciplina::create(['curso_id' => 1, 'instituicao_id' => 1, 'disciplina_id' => 1]);

        \App\CursoInstituicaoDisciplina::create(['curso_id' => 1, 'instituicao_id' => 2, 'disciplina_id' => 1]);
        \App\CursoInstituicaoDisciplina::create(['curso_id' => 1, 'instituicao_id' => 1, 'disciplina_id' => 3]);
    }
}
