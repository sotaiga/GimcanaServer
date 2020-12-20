<?php
header('Content-Type: application/json'); 

$servername = "127.0.0.1"; //"lhcp1017.webapps.net";
$username = "ts1i59ps_sotaiga";
$password = "9ba0ji5C";
$database = "ts1i59ps_gimcanace20";

// Create connection 
$conn = new mysqli($servername, $username, $password, $database);

try
{    
  // Check connection
  if ($conn->connect_error) 
  {
      throw new Exception("Connection failed: " . $conn->connect_error);
  }
    
  try 
  {
    $conn->begin_transaction();

    // Obtenir l'identificador de l'aplicació.

    if (!isSet($_POST['app_id']))
    {
      throw new Exception("Cal especificar l′identificador de l′aplicació");
    }
    
    $app_id = $_POST['app_id'];
    
    // Obtenir l'identificador de l'equip.
    
    if (!isSet($_POST['equip_id']))
    {
      throw new Exception("Cal especificar l′identificador de l′equip");
    }
    
    $equip_id = $_POST['equip_id'];

    // Comprovar que no s'hagi participat abans.

    $select_script = " SELECT COUNT(*) as counter ". 
                     "   FROM answers ".
                     "  WHERE answer_app_id   = '". $app_id. "' ".
                     "    AND answer_equip_id =  ". $equip_id;
    
    if ($resultat = $conn->query($select_script))
    {
       $row = $resultat->fetch_object();
       if ($row->counter > 0) 
       {
         throw new \Exception("Respostes de la gimcana ja enviades!");
       }
    }
    else 
    {
       throw new \Exception($conn->error);
    }

    $continuar = true;
    $i = 1;
    
    while ($continuar) 
    {
      $index = str_pad($i, 2, '0', STR_PAD_LEFT);
      
      if ((isSet($_POST['punt_codi_'. $index])) && (isSet($_POST['pregunta_codi_'. $index])) && (isSet($_POST['resposta_codi_'. $index])))
      {
        $punt_codi     = $_POST['punt_codi_'.     $index];
        $pregunta_codi = $_POST['pregunta_codi_'. $index];
        $resposta_codi = $_POST['resposta_codi_'. $index];
      
        $insert_script = " INSERT ". 
                         "   INTO answers ".
                         "      ( ".
                         "        answer_app_id, ".
                         "        answer_equip_id, ".
                         "        answer_punt_codi, ".
                         "        answer_pregunta_codi, ".
                         "        answer_resposta_codi, ".
                         "        answer_ordre ".
                         "      ) ".
                         " VALUES ".
                         "      ( ".
                         "        '". $app_id. "',".
                         "         ". $equip_id. ",".
                         "        '". $punt_codi. "',".
                         "        '". $pregunta_codi. "',".
                         "        '". $resposta_codi. "',".
                         "         ". $i. 
                         "      ) ";

        if ($conn->query($insert_script)) 
        {
          $i++;
        }
        else 
        {
          throw new \Exception($conn->error);
        }
      }
      else 
      {
        $continuar = false;
      }
    }
    
    // Calcular el punts.

    $update_punts_script = " UPDATE equips ".
                           "  INNER JOIN ".
                           "      ( ".
                           "        SELECT answer_app_id        as answer_app_id, ".
                           "               answer_equip_id      as answer_equip_id, ".
                           "               sum(plantilla_punts) as puntuacio, ".
                           "               count(*)             as counter ".
                           "          FROM answers ".
                           "         INNER JOIN plantilla ". 
                           "            ON plantilla_punt_codi      = answer_punt_codi ".
                           "           AND plantilla_pregunta_codi  = answer_pregunta_codi ".
                           "           AND plantilla_resposta_codi  = answer_resposta_codi  ".
                           "      GROUP BY answer_app_id, ".
                           "               answer_equip_id ".
                           "      ) AS m ".
                           "     ON m.answer_app_id   = equip_app_id ".
                           "    AND m.answer_equip_id = equip_id ".
                           "    SET equip_puntuacio     = m.puntuacio, ".
                           "        equip_num_correctes = m.counter, ".
                           "        equip_fi            = now() ".
                           "  WHERE equip_app_id = '". $app_id. "'".
                           "    AND equip_id     = ". $equip_id;

    if (!$conn->query($update_punts_script)) 
    {
      throw new \Exception($conn->error);
    }

    // Calcular ordre.

    $update_ordre_script = " UPDATE equips ".
                           "  INNER JOIN ".
                           "      ( ".
                           "        SELECT answer_app_id   as answer_app_id, ".
                           "               answer_equip_id as answer_equip_id, ".
                           "               count(*)        as counter ".
                           "          FROM answers ".
                           "         INNER JOIN plantilla ". 
                           "            ON plantilla_punt_codi     = answer_punt_codi ".
                           "           AND plantilla_pregunta_codi = answer_pregunta_codi ".
                           "           AND plantilla_ordre         = answer_ordre  ".
                           "      GROUP BY answer_app_id, ".
                           "               answer_equip_id ".
                           "      ) AS m ".
                           "     ON m.answer_app_id   = equip_app_id ".
                           "    AND m.answer_equip_id = equip_id ".
                           "    SET equip_ordre_correcte      = (m.counter = 17), ".
                           "        equip_num_ordre_correctes = m.counter ".
                           "  WHERE equip_app_id = '". $app_id. "'".
                           "    AND equip_id     = ". $equip_id;

    if (!$conn->query($update_ordre_script)) 
    {
      throw new \Exception($conn->error);
    }

    // --
    
    $select2_script = " SELECT equip_ordre_correcte                         as sorted, ". 
                      "        equip_puntuacio                              as points, ".
                      "        TIMESTAMPDIFF(MINUTE, equip_inici, equip_fi) as minutes ".
                      "   FROM equips ".
                      "  WHERE equip_app_id = '". $app_id. "'".
                      "    AND equip_id     = ". $equip_id;
    
    if ($resultat2 = $conn->query($select2_script))
    {
       $row2 = $resultat2->fetch_object();
    
       // --
    
       $conn->commit();
    
       echo json_encode(array('status' => 'OK', 'points' => $row2->points, 'minutes' => $row2->minutes, 'sorted' => ($row2->sorted == 1)));
    }
    else 
    {
       throw new \Exception($conn->error);
    }
  }
  catch (Exception $e)
  {
    $conn->rollback();
    throw $e;
  }
  finally
  {
    $conn->close();
  }
}
catch (Exception $e)
{
  echo json_encode(['status' => 'ERR', 'message' => $e->getMessage()]);
}





