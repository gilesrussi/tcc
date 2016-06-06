<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{

    /**
     * Variável que diz o nome da tabela no banco de dados :D
     *
     * @var string $table
     */
    protected $table = 'materiais';

    public function turma() {
        return $this->belongsTo('App\Turma');
    }
}
