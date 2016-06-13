<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Feriado extends Model
{
    protected $fillable = ['dia'];

    public static function nao_eh_feriado(Carbon $dia) {
        return !(bool) Feriado::where('dia', $dia)->count();
    }
}
