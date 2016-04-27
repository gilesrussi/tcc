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
        $cid = App\CursoInstituicaoDisciplina::all();
        foreach($cid as $c) {
            App\Turma::create(['instituicao_curso_disciplina_id' => $c->id]);
        }
    }
}
