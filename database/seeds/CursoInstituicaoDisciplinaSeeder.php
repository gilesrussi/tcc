<?php

use Illuminate\Database\Seeder;

class CursoInstituicaoDisciplinaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cursos = App\Curso::all();
        $disciplinas = App\Disciplina::all();
        $instituicoes = App\Instituicao::all();
        $inst = $instituicoes->random(2);
        foreach($inst as $i) {
            $curs = $cursos->random(3);
            $disc = $disciplinas->random(3);
            foreach($curs as $c) {
                foreach($disc as $d) {
                    App\CursoInstituicaoDisciplina::create(['instituicao_id' => $i->id, 'curso_id' => $c->id, 'disciplina_id' => $d->id]);
                }
            }
        }
    }
}
