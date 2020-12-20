<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gimcana extends Model
{
    use HasFactory;

    protected $table = "gimcanes";

    protected $primaryKey = 'gimcana_id';

    protected $fillable =
    [
        'gimcana_nom',
        'gimcana_data',
        'gimcana_patro'
    ];

    protected $guarded =
    [
        'gimcana_id'
    ];

    protected $casts =
    [
        'gimcana_data' => 'datetime:Y-m-d',
    ];

    public $timestamps = true;
}
