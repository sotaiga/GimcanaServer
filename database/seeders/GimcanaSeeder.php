<?php

namespace Database\Seeders;

use App\Models\Gimcana;

use DB;

use Illuminate\Database\Seeder;

class GimcanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gimcanes')->delete();

        // --

        Gimcana::create(
          [
              'gimcana_nom'   => 'Gimcana Medieval - Castelló dߴEmpúries',
              'gimcana_data'  => '2020/12/24',
              'gimcana_patro' => '2090522545367'
          ]
        );
    }
}
