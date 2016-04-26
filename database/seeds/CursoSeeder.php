<?php

use Illuminate\Database\Seeder;

class CursoSeeder extends Seeder
{
    protected $nomes = [
        'Engenharia Elétrica',
        'Engenharia de Produção',
        'Fisioterapia',
        'Letras Inglês',
        'Zootecnia',
        'Sistemas para Internet',
        'Medicina Veterinária',
        'Desenho Industrial'
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->nomes as $nome) {
            App\Curso::create(['nome' => $nome]);
        }
    }
}
