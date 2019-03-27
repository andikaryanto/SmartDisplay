<?php

class Player extends yidas\rest\Controller
{

  public function multimedia()
  {
    $multimedia = array();
    $player;
    $return;
    
    $playername = $this->input->get('playername');

    $return = $this->getMultimedia($playername);

    $this->response->json($return, 200);
  }

  public function ticker()
  { 
    $playername = $this->input->get('playername');
    $this->response->json($this->db->query("CALL sp_getplayerticker('".$playername."')")->result(), 200);
  }

  public function register(){
    $playername = $this->input->get('playername'); 
    $isbrowser = $this->input->get('isbrowser');
    $ipaddress = $this->input->ip_address();

    if($playername){
      $params = array(
        'where' => array(
          'Name' => $playername
        )
      );

      $player = $this->M_players->get(null, null, $params);
      if($player){
        if($player->IsRegistered == 0){
          $player->IpAddress = $ipaddress;
          $player->IsRegistered = 1;
          if($isbrowser == "true"){
            $player->DeviceId = "Browser";
            $this->getMultimedia($playername);
          } else {
            $player->DeviceId = "Mobile";
          }
          $player->save();
          
          $return = array(
            'data' => $player,
            'status' => playerstatusarr_enum('available')
          );


          $this->response->json($return, 200);
        } else {

          $return = array(
            'data' => null,
            'status' => playerstatusarr_enum('registered')
          );

          $this->response->json($return, 200);
        }
      } else {

        $return = array(
          'data' => null,
          'status' => playerstatusarr_enum('notlisted')
        );

        $this->response->json($return, 200);

      }
    }

  }


  // function

  private function getMultimedia($playername){
    $multimedia = array();
    $params = array(
      'where' => array(
        'Name' => $playername
      )
    );

    $player = $this->M_players->get(null, null, $params);

    if($player){
      $DB1 = $this->load->database($this->db->database, TRUE);
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
            'playerId' => $results[0]->PlayerId,
            'playerName' => $results[0]->PlayerName
        );

        
        $return['result'] = $player;
        $return['result']['multimedia'] = $multimedia;
        $return['status'] = playerstatusarr_enum('registered');

        $this->saveTplayer($results);

        return $return;
        
        
      } else {
        $return['result'] = null;
        $return['status'] = playerstatusarr_enum('registered');

        return $return;
      }
      
    } else {

      $return['result'] = null;
      $return['status'] = playerstatusarr_enum('notlisted');
      return $return;
    }
  }

  private function saveTplayer($playermultimedia){
    foreach($playermultimedia as $player){
      $params = array(
        'where' => array(
          'M_Player_Id' => $player->PlayerId,
          'Id' => $player->PlayerMultimediaId
        )
      );

      $mplayermulmed = $this->M_playermultimedias->get(null, null, $params);
      if($mplayermulmed){
        $mplayermulmed->IsUpdated = 0;
        $mplayermulmed->save();
        $downloadUrl = $this->downloadMultimedia($player->Url);

        $paramsmulmed = array(
          'where' => array(
            'PlayerId' => $player->PlayerId,
            'MultimediaId' => $player->MultimediaId
          )
        );
        $tplayer = $this->T_playermultimedias->get(null, null, $paramsmulmed);
        if($tplayer){
          if($player->IsDeleted == 0){
            if($tplayer->Url != $player->Url || 
                $tplayer->ActiveDate != $player->ActiveDate ||
                $tplayer->InactiveDate != $player->InactiveDate ||
                $tplayer->TimeStart != $player->TimeStart || 
                $tplayer->TimeEnd != $player->TimeEnd){

                  $tplayer->PlayerId = $player->PlayerId;
                  $tplayer->PlayerName = $mplayermulmed->get_M_Player()->Name;
                  $tplayer->MultimediaId = $player->MultimediaId;
                  $tplayer->Url = $player->Url;
                  $tplayer->MultimediaName = $player->MultimediaName;
                  $tplayer->ActiveDate = $player->ActiveDate;
                  $tplayer->InactiveDate = $player->InactiveDate;
                  $tplayer->TimeStart = $player->TimeStart;
                  $tplayer->TimeEnd = $player->TimeEnd;
                  $tplayer->DownloadedUrl = $downloadUrl;
                  $tplayer->save();
              }
          } else {
            $tplayer->delete();
          }
        } else {
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
        }

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