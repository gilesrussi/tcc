<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(InstituicaoSeeder::class);
        $this->call(CursoSeeder::class);
        $this->call(DisciplinaSeeder::class);
        // $this->call(UsersTableSeeder::class);
    }
}
