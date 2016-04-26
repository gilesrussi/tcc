<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instituicao extends Model
{
    /**
     * Variável que diz o nome da tabela no banco de dados :D
     *
     * @var string $table
     */
    protected $table = 'instituicoes';

    protected $fillable = ['nome', 'sigla', 'url'];
}
