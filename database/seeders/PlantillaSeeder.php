<?php

namespace Database\Seeders;

use App\Models\Gimcana;
use App\Models\Plantilla;

use DB;

use Illuminate\Database\Seeder;

class PlantillaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plantilles')->delete();

        // --

        $gimcana = Gimcana::where('gimcana_nom', '=', 'Gimcana Medieval - Castelló dߴEmpúries')->first();

        if ($gimcana != null)
        {
            $punts = 10;

            for ($i = 1; $i < 18; $i++)
            {
                $str_index = str_pad($i, 2, '0', STR_PAD_LEFT);

                Plantilla::create(
                  [
                      'plantilla_gimcana_id'    => $gimcana->gimcana_id,
                      'plantilla_punt_codi'     => 'PUNT'. $str_index,
                      'plantilla_pregunta_codi' => 'PREGUNTA'. $str_index,
                      'plantilla_resposta_codi' => 'RESPOSTA'. $str_index. '_01',
                      'plantilla_ordre'         => $i,
                      'plantilla_punts'         => $punts,
                  ]
                );
            }
        }
    }
}
