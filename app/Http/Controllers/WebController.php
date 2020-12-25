<?php

namespace App\Http\Controllers;

use App\Models\Equip;
use App\Models\Gimcana;
use App\Models\Plantilla;
use App\Models\Resposta;

use DateTime;
use DB;
use Exception;

use Illuminate\Http\Request;

class WebController extends Controller
{
    public function googlePlay()
    {
        return redirect('https://play.google.com/store/apps/details?id=com.sotaiga.apps.gimcanace20');
    }

    // -------------------------------------------------------------------------

    public function start()
    {
        $gimcana = Gimcana::where('gimcana_nom', '=', 'Gimcana Medieval - Castelló dߴEmpúries')->first();

        if ($gimcana != null)
        {
            $title = 'Pàgina inicial | '. $gimcana->gimcana_nom;

            return view('start',
                [
                    'title'   => $title,
                    'gimcana' => $gimcana
                ]
            );
        }
        else
        {
            return "Gimcana no trobada.";
        }
    }

    public function getPin($in_gimcana_id)
    {
        $gimcana = Gimcana::where('gimcana_id', '=', $in_gimcana_id)->first();

        if ($gimcana != null)
        {
            $title = 'Obtenir el PIN | Gimcana Medieval - Castelló dߴEmpúries';

            $data = new DateTime();

            return view('get_pin',
                [
                    'title'   => $title,
                    'gimcana' => $gimcana,
                    'data'    => $data->format('Y-m-d'),
                ]
            );
        }
        else
        {
            return "Gimcana no trobada.";
        }
    }

    public function doGetPin(Request $in_request)
    {
        $gimcana = Gimcana::where('gimcana_id', '=', $in_request->input('gimcana_id', ''))->first();

        if ($gimcana != null)
        {
            $title = 'Obtenir el PIN | Gimcana Medieval - Castelló dߴEmpúries';

            $data = DateTime::createFromFormat('Y-m-d', $in_request->input('data'));

            $pin = getPin($gimcana->gimcana_patro, $in_request->input('gimcana_patro'), $data);

            return view('get_pin',
                [
                    'title'   => $title,
                    'gimcana' => $gimcana,
                    'data'    => $data->format('Y-m-d'),
                    'pin'     => $pin
                ]
            );
        }
        else
        {
            return "Gimcana no trobada.";
        }
    }

    public function standings($in_gimcana_id)
    {
        $gimcana = Gimcana::where('gimcana_id', '=', $in_gimcana_id)->first();

        if ($gimcana != null)
        {
            $title = 'Participants | Gimcana Medieval - Castelló dߴEmpúries';

            $equips = Equip::where('equip_gimcana_id', '=', $gimcana->gimcana_id)
            ->orderBy('equip_punts_respostes_correctes', 'desc')
            ->orderBy('equip_punts_respostes_en_ordre', 'desc')
            ->orderByRaw('equip_fi - equip_inici DESC')
            ->get();

            return view('standings',
                [
                    'title'   => $title,
                    'gimcana' => $gimcana,
                    'equips'  => $equips
                ]
            );
        }
        else
        {
            return "Gimcana no trobada.";
        }
    }

    // -------------------------------------------------------------------------

    public function doSignUp(Request $in_request)
    {
        try
        {
            $prm_gimcana_id  = $in_request->input('gimcana_id', '');
            $prm_app_id      = $in_request->input('app_id', '');
            $prm_equip_nom   = $in_request->input('nom', '');
            $prm_equip_email = $in_request->input('email', '');

            if ($prm_gimcana_id == "")
            {
                throw new Exception("Cal especificar l′identificador de la gimcana.");
            }

            if ($prm_app_id == "")
            {
                throw new Exception("Cal especificar l′identificador de l′aplicació.");
            }

            if ($prm_equip_nom == "")
            {
                throw new Exception("Cal especificar un nom per l′equip.");
            }

            if ($prm_equip_email == "")
            {
                throw new Exception("Cal especificar una adreça electrònica per l′equip.");
            }

            DB::beginTransaction();

            try
            {
                $gimcana = Gimcana::where('gimcana_id', '=', $prm_gimcana_id)->first();

                if ($gimcana == null)
                {
                    throw new Exception("La gimcana especificada no existeix.");
                }

                // Comprovar si l'adreça electrònica especificada ja s'ha registrat.

                $equips_count = Equip::where('equip_gimcana_id', '=', $prm_gimcana_id)
                                     ->where('equip_email', '=', $prm_equip_email)
                                     ->count();

                if ($equips_count == 1)
                {
                    throw new Exception("L′adreça electrònica especificada ja està usada.");
                }

                // Si no existeix es dóna d'alta.

                $equip = Equip::create(
                    [
                        'equip_gimcana_id'                => $prm_gimcana_id,
                        'equip_dispositiu'                => $prm_app_id,
                        'equip_nom'                       => $prm_equip_nom,
                        'equip_email'                     => $prm_equip_email,
                    ]
                );

                // --

                DB::commit();

                // --

                return response()->json(
                    [
                        'status'   => 'OK',
                        'equip_id' => $equip->equip_id,
                        'message'  => ''
                    ]
                );

            }
            catch (Exception $e)
            {
                DB::rollBack();
                throw $e;
            }
        }
        catch (Exception $e)
        {
          return response()->json(
              [
                  'status'  => 'ERR',
                  'message' => $e->getMessage(),
              ]
          );
        }
    }

    public function doSendingAnswers(Request $in_request)
    {
        try
        {
            $prm_gimcana_id  = $in_request->input('gimcana_id', '');
            $prm_app_id      = $in_request->input('app_id', '');
            $prm_equip_id    = $in_request->input('equip_id', '');

            if ($prm_gimcana_id == "")
            {
                throw new Exception("Cal especificar l′identificador de la gimcana.");
            }

            if ($prm_app_id == "")
            {
                throw new Exception("Cal especificar l′identificador de l′aplicació.");
            }

            if ($prm_equip_id == "")
            {
                throw new Exception("Cal especificar l′identificador de l′equip.");
            }

            DB::beginTransaction();

            try
            {
                $gimcana = Gimcana::where('gimcana_id', '=', $prm_gimcana_id)->first();

                if ($gimcana == null)
                {
                    throw new Exception("La gimcana especificada no existeix.");
                }

                $equip = Equip::where('equip_id', '=', $prm_equip_id)->first();

                if ($equip == null)
                {
                    throw new Exception("L′equip especificat no existeix.");
                }

                // Comprovar que el mateix equip no hagi enviat ja les respostes.

                $respostes_count = Resposta::where('resposta_gimcana_id', '=', $prm_gimcana_id)
                                     ->where('resposta_equip_id', '=', $prm_equip_id)
                                     ->count();
                if ($respostes_count > 0)
                {
                    throw new Exception("Respostes ja enviades per l′equip especificat.");
                }

                // --

                $plantilles = Plantilla::where('plantilla_gimcana_id', '=', $gimcana->gimcana_id)
                ->orderBy('plantilla_ordre')
                ->get();

                // 1a pregunta a partir de que cal comprovar l'ordre.
                $plantilla_01 = $plantilles[0];

                // Emmagatzemar respostes enviades.

                $continuar = true;
                $i = 1;
                $in = false;
                $respostes_counter = 0;

                $respostes_in  = array();
                $respostes_out = array();

                while ($continuar)
                {
                    $index = str_pad($i, 2, '0', STR_PAD_LEFT);

                    $prm_punt_codi     = $in_request->input('punt_codi_'. $index, '');
                    $prm_pregunta_codi = $in_request->input('pregunta_codi_'. $index, '');
                    $prm_resposta_codi = $in_request->input('resposta_codi_'. $index, '');

                    if (($prm_punt_codi != "") && ($prm_pregunta_codi != "") && ($prm_resposta_codi != ""))
                    {
                        Resposta::create(
                            [
                                'resposta_gimcana_id'    => $gimcana->gimcana_id,
                                'resposta_dispositiu'    => $prm_app_id,
                                'resposta_equip_id'      => $equip->equip_id,
                                'resposta_punt_codi'     => $prm_punt_codi,
                                'resposta_pregunta_codi' => $prm_pregunta_codi,
                                'resposta_resposta_codi' => $prm_resposta_codi,
                                'resposta_ordre'         => $i,
                            ]
                        );

                        $respostes_counter++;

                        if ($in)
                        {
                            array_push($respostes_in, $prm_pregunta_codi);
                        }
                        else
                        {
                            if ($plantilla_01->plantilla_pregunta_codi == $prm_pregunta_codi)
                            {
                                $in = true;
                                array_push($respostes_in, $prm_pregunta_codi);
                            }
                            else
                            {
                                array_push($respostes_out, $prm_pregunta_codi);
                            }
                        }
                    }
                    else
                    {
                        $continuar = false;
                    }

                    $i++;
                }

                $respostes_ordre = array_merge($respostes_in, $respostes_out);

                // Calcular la puntuació.

                $puntuacio = DB::table('respostes')
                ->join('plantilles', function($join)
                {
                    $join->on('resposta_gimcana_id', '=', 'plantilla_gimcana_id')
                    ->on('resposta_punt_codi',       '=', 'plantilla_punt_codi')
                    ->on('resposta_pregunta_codi',   '=', 'plantilla_pregunta_codi')
                    ->on('resposta_resposta_codi',   '=', 'plantilla_resposta_codi');
                })
                ->where('resposta_equip_id', '=', $equip->equip_id)
                ->groupBy('resposta_equip_id')
                ->select(DB::raw('sum(plantilla_punts) as punts, count(*) as counter'))
                ->get();

                if ($puntuacio->count() == 0)
                {
                    throw new Exception("Error en el càlcul de la puntuació.");
                }

                // Mirar que totes les respostes s'hagin enviat..

                $plantilles = Plantilla::where('plantilla_gimcana_id', '=', $gimcana->gimcana_id)
                ->orderBy('plantilla_ordre')
                ->get();

                if ($respostes_counter != $plantilles->count())
                {
                    throw new Exception("No s′ha especificat totes les respostes de la gimcana.");
                }

                // Calcular l'ordre.

                $respostes_ordre_correcte = 0;

                foreach ($plantilles as $key => $plantilla)
                {
                    $pregunta_codi = $respostes_ordre[$key];

                    if ($plantilla->plantilla_pregunta_codi == $pregunta_codi)
                    {
                        $respostes_ordre_correcte++;
                    }
                }

                // --

                $now = new DateTime();

                $equip->equip_fi                        = $now->format('Y-m-d H:i:s');
                $equip->equip_num_respostes_correctes   = $puntuacio[0]->counter;
                $equip->equip_punts_respostes_correctes = $puntuacio[0]->punts;
                $equip->equip_ordre_correcte            = ($respostes_ordre_correcte == $plantilles->count());
                $equip->equip_num_respostes_en_ordre    = $respostes_ordre_correcte;
                $equip->equip_punts_respostes_en_ordre  = ($respostes_ordre_correcte * 5);

                $equip->update();

                // --

                DB::commit();

                // --

                return response()->json(
                    [
                        'status'  => 'OK',
                        'points'  => $equip->punts,
                        'minutes' => $equip->minuts,
                        'sorted'  => ($equip->ordre_correcte == 1),
                        'message' => ''
                    ]
                );
            }
            catch (Exception $e)
            {
                DB::rollBack();
                throw $e;
            }
        }
        catch (Exception $e)
        {
          return response()->json(
              [
                  'status'  => 'ERR',
                  'message' => $e->getMessage(),
              ]
          );
        }
    }
}
