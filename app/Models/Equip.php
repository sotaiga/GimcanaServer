<?php

namespace App\Models;

use DateTime;
use DateTimeZone;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equip extends Model
{
    use HasFactory;

    protected $table = "equips";

    protected $primaryKey = 'equip_id';

    protected $fillable =
    [
        'equip_gimcana_id',
        'equip_dispositiu',
        'equip_nom',
        'equip_email',
        'equip_inici',
        'equip_fi',
        'equip_num_respostes_correctes',
        'equip_punts_respostes_correctes',
        'equip_ordre_correcte',
        'equip_num_respostes_en_ordre',
        'equip_punts_respostes_en_ordre',
    ];

    protected $guarded =
    [
        'equip_id'
    ];

    protected $casts =
    [
        'equip_inici' => 'datetime:Y-m-d h:i:s',
        'equip_fi'    => 'datetime:Y-m-d h:i:s',
    ];

    public $timestamps = true;

    // -------------------------------------------------------------------------

    protected static function booted()
    {
        static::creating(function ($user)
            {
                $now = new DateTime();

                $user->equip_inici                     = $now->format('Y-m-d H:i:s');
                $user->equip_fi                        = null;
                $user->equip_num_respostes_correctes   = 0;
                $user->equip_punts_respostes_correctes = 0;
                $user->equip_ordre_correcte            = false;
                $user->equip_num_respostes_en_ordre    = 0;
                $user->equip_punts_respostes_en_ordre  = 0;
            }
        );
    }

    // -------------------------------------------------------------------------

    public function getPuntsAttribute($value)
    {
        return $this->equip_punts_respostes_correctes + $this->equip_punts_respostes_en_ordre;
    }

    public function getMinutsAttribute($value)
    {
        if ($this->equip_inici == null || $this->equip_fi)
        {
            $inici = DateTime::createFromFormat('Y-m-d H:i:s', $this->equip_inici, new DateTimeZone(config('app.timezone')));
            $fi    = DateTime::createFromFormat('Y-m-d H:i:s', $this->equip_fi, new DateTimeZone(config('app.timezone')));

            $diff = $inici->diff($fi);

            return ($diff->h * 60) + $diff->i;
        }
        else
        {
            return null;
        }
    }
}
