<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plantilla extends Model
{
    use HasFactory;

    protected $table = "plantilles";

    protected $primaryKey = 'plantilla_id';

    protected $fillable =
    [
        'plantilla_gimcana_id',
        'plantilla_punt_codi',
        'plantilla_pregunta_codi',
        'plantilla_resposta_codi',
        'plantilla_ordre',
        'plantilla_punts',
    ];

    protected $guarded =
    [
        'plantilla_id'
    ];

    public $timestamps = true;
}
