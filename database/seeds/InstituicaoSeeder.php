<?php

use Illuminate\Database\Seeder;

class InstituicaoSeeder extends Seeder
{
    private $nomes = [
        'Universidade Federal de Santa Maria',
        'Universidade Federal do Rio Grande do Sul',
        'Universidade Franciscana de Santa Maria',
        'Universidade Luterana do Brasil',
        'Instituto Federal Farroupilha',
        'Colégio Politécnico de Santa Maria',
        'Colédio Técnico Industrial de Santa Maria'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Instituicao::class, 7)->create();
    }
}
