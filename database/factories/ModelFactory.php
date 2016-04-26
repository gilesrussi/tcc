<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Instituicao::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->name,
        'sigla' => $faker->stateabbr,
        'url' => $faker->url,
    ];
});

$factory->define(App\Curso::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->name,
    ];
});

$factory->define(App\Disciplina::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->name,
    ];
});