<?php

use Illuminate\Database\Seeder;
use App\Horarios;

class HorarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 7; $i++) {
            for($j = 7; $j < 23; $j++) {
                Horarios::create(array('dia' => $i, 'hora' => sprintf('%02d', $j) . ':00'));
                Horarios::create(array('dia' => $i, 'hora' => sprintf('%02d', $j) . ':30'));
            }
        }
    }
}
