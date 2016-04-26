<?php

use Illuminate\Database\Seeder;

class DisciplinaSeeder extends Seeder
{
    protected $nomes = [
        'Cálculo A',
        'Cálculo B',
        'Algebra Linear',
        'Introdução à Engenharia Elétrica',
        'Eletromagnetismo A',
        'Métodos Numéricos Computacionais',
        'Desenho Técnico',
        'Metodologia',
        'Saúde e Sociedade'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->nomes as $nome) {
            App\Disciplina::create(['nome' => $nome]);
        }
    }
}
