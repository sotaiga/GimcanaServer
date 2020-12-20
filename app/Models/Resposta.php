<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resposta extends Model
{
    use HasFactory;

    protected $table = "respostes";

    protected $primaryKey = 'resposta_id';

    protected $fillable =
    [
        'resposta_gimcana_id',
        'resposta_dispositiu',
        'resposta_equip_id',
        'resposta_punt_codi',
        'resposta_pregunta_codi',
        'resposta_resposta_codi',
        'resposta_ordre',
    ];

    protected $guarded =
    [
        'resposta_id'
    ];

    public $timestamps = true;
}
