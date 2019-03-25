<?php

class Player extends yidas\rest\Controller
{
  public function multimedia()
  {
    $multimedia = array();
    $player;
    $return;
    $DB1 = $this->load->database($this->db->database, TRUE);
    $playername = $this->input->get('playername');
    $results = $DB1->query("CALL sp_getplayermultimedia('".$playername."')")->result();
    freeDBResource($DB1->conn_id);
    

    if($results){
      foreach($results as $result){
        $mulmed['PlayerMultimediaId'] = $result->PlayerMultimediaId;
        $mulmed['MultimediaId'] = $result->MultimediaId;
        $mulmed['MultimediaName'] = $result->MultimediaName;
        $mulmed['Url'] = $result->Url;
        $mulmed['IsDeleted'] = $result->IsDeleted;
        $mulmed['ActiveDate'] = $result->ActiveDate;
        $mulmed['InactiveDate'] = $result->InactiveDate;
        $mulmed['TimeStart'] = $result->TimeStart;
        $mulmed['TimeEnd'] = $result->TimeEnd;

        array_push($multimedia, $mulmed);
      }

      $player = array(
          'PlayerId' => $results[0]->PlayerId,
          'PlayerName' => $results[0]->PlayerName
      );

      
      $return['result'] = $player;
      $return['result']['Multimedia'] = $multimedia;

      $this->saveTplayer($results);
      
      
    } else {
      $return['result'] = null;
    }

    // echo json_encode($return, JSON_PRETTY_PRINT);
    
    
    $this->response->json($return, 200);
  }

  public function ticker()
  { 
    $playername = $this->input->get('playername');
    $this->response->json($this->db->query("CALL sp_getplayerticker('".$playername."')")->result(), 200);
  }

  public function saveTplayer($playermultimedia){
    foreach($playermultimedia as $player){
      $mplayermulmed = $this->M_playermultimedias->get($player->PlayerMultimediaId);
      if($mplayermulmed){
        $mplayermulmed->IsUpdated = 0;
        // $mplayermulmed->save();
        $downloadUrl = $this->downloadMultimedia($player->Url);
        $tplayermulmed = $this->T_playermultimedias->new_object();
        $tplayermulmed->PlayerId = $player->PlayerId;
        $tplayermulmed->PlayerName = $mplayermulmed->get_M_Player()->Name;
        $tplayermulmed->MultimediaId = $player->MultimediaId;
        $tplayermulmed->Url = $player->Url;
        $tplayermulmed->MultimediaName = $player->MultimediaName;
        $tplayermulmed->IsDeleted = $player->IsDeleted;
        $tplayermulmed->ActiveDate = $player->ActiveDate;
        $tplayermulmed->InactiveDate = $player->InactiveDate;
        $tplayermulmed->TimeStart = $player->TimeStart;
        $tplayermulmed->TimeEnd = $player->TimeEnd;
        $tplayermulmed->DownloadedUrl = $downloadUrl;
        $tplayermulmed->save();

        $mplayermulmed->IsUpdated = 0;
        $mplayermulmed->save();
      }
    }
  }

  private function downloadMultimedia($url){
    $arrUrl = explode("/", $url);
    $savedUrl = 'C:\download\\'.$arrUrl[3];

    $config = fileconfig_ftp();

    $this->ftp->connect($config);

    $this->ftp->download($url, $savedUrl);

    $this->ftp->close();

    return $savedUrl;

  }
}