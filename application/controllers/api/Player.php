<?php

class Player extends yidas\rest\Controller
{

  public function multimedia()
  {    
    $playername = $this->input->get('playername');

    if($playername){
      $return = $this->getMultimedia($playername);
  
      $this->response->json($return, 200);
    }
  }

  public function ticker()
  { 
    $playername = $this->input->get('playername');

    if($playername){

      $return = $this->getTicker($playername);
      $this->response->json($return, 200);
    }
  }

  public function updateMultimedia(){
    $playermultimediaid = $this->input->get('playermultimediaid');

    
    if($playermultimediaid){
      if($this->updateMultimediaByPlayerMultimedia($playermultimediaid)){
        $return = array(
          'status' => "success"
        );
  
        $this->response->json($return, 200);
      }
    }
  }

  public function updateTicker(){
    $playertickerid = $this->input->get('playertickerid');

    if($playertickerid){
      if($this->updateTickerByPlayerTicker($playertickerid)){
        $return = array(
          'status' => "success"
        );
  
        $this->response->json($return, 200);
      }
    }
  }

  public function register(){
    $playername = $this->input->get('playername'); 
    $deviceid = $this->input->get('deviceid'); 
    $ipaddress = $this->input->ip_address();

    
    if($playername && $deviceid){
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
          $player->DeviceId = $deviceid;
          $player->save();
          
          $return = array(
            'data' => $player,
            'status' => playerstatusarr_enum('available')
          );


          $this->response->json($return, 200);
        } else {

          $return = array(
            'data' => $player,
            'status' => playerstatusarr_enum('registered')
          );

          $this->response->json($return, 200);
        }
      } else {

        $return = array(
          'data' => $player,
          'status' => playerstatusarr_enum('notlisted')
        );

        $this->response->json($return, 200);

      }
    }

  }

  public function tickersetting(){
    $params = array(
      'where' => array(
        'IsActive' => 1
      )
    );

    $tickersetting = $this->M_tickersettings->get(null, null, $params);
    $this->response->json($tickersetting, 200);

   }




  // function

  private function getTicker($playername){
    $ticker = array();
    $params = array(
      'where' => array(
        'Name' => $playername
      )
    );

    $player = $this->M_players->get(null, null, $params);

    if($player){
      $DB1 = $this->load->database($this->db->database, TRUE);
      $results = $DB1->query("CALL sp_getplayerticker('".$playername."')")->result();
      freeDBResource($DB1->conn_id);

      if($results){
        foreach($results as $result){
          $tick['PlayerTickerId'] = $result->PlayerTickerId;
          $tick['TickerId'] = $result->TickerId;
          $tick['TickerName'] = $result->TickerName;
          $tick['TickerContent'] = $result->TickerContent;
          $tick['IsDeleted'] = $result->IsDeleted;
          $tick['ActiveDate'] = $result->ActiveDate;
          $tick['InactiveDate'] = $result->InactiveDate;
          $tick['TimeStart'] = $result->TimeStart;
          $tick['TimeEnd'] = $result->TimeEnd;

          array_push($ticker, $tick);
        }

        $player = array(
            'playerId' => $results[0]->PlayerId,
            'playerName' => $results[0]->PlayerName
        );

        
        $return['result'] = $player;
        $return['result']['ticker'] = $ticker;
        $return['status'] = playerstatusarr_enum('registered');
        // $this->saveTplayerticker($results);

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
          $mulmed['ShowTime'] = $result->ShowTime;
          $mulmed['MultimediaType'] = $result->MultimediaType;
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

        // $this->saveTplayermultimedia($results);

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

  private function saveTplayermultimedia($playermultimedia){
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

  private function saveTplayerticker($playerticker){
    foreach($playerticker as $player){
      $params = array(
        'where' => array(
          'M_Player_Id' => $player->PlayerId,
          'Id' => $player->PlayerTickerId
        )
      );

      $mplayerticker = $this->M_playertickers->get(null, null, $params);
      if($mplayerticker){
        // $mplayerticker->IsUpdated = 0;
        // $mplayerticker->save();

        $paramsmulmed = array(
          'where' => array(
            'PlayerId' => $player->PlayerId,
            'TickerId' => $player->TickerId
          )
        );
        $tplayer = $this->T_playertickers->get(null, null, $paramsmulmed);
        echo json_encode($tplayer);
        if($tplayer){
          if($player->IsDeleted == 0){
            if($tplayer->TickerContent != $player->TickerContent || 
                $tplayer->ActiveDate != $player->ActiveDate ||
                $tplayer->InactiveDate != $player->InactiveDate ||
                $tplayer->TimeStart != $player->TimeStart || 
                $tplayer->TimeEnd != $player->TimeEnd){

                  $tplayer->PlayerId = $player->PlayerId;
                  $tplayer->PlayerName = $mplayerticker->get_M_Player()->Name;
                  $tplayer->TickerId = $player->TickerId;
                  $tplayer->TickerContent = $player->TickerContent;
                  $tplayer->TickerName = $player->TickerName;
                  $tplayer->ActiveDate = $player->ActiveDate;
                  $tplayer->InactiveDate = $player->InactiveDate;
                  $tplayer->TimeStart = $player->TimeStart;
                  $tplayer->TimeEnd = $player->TimeEnd;
                  $tplayer->save();
              }
          } else {
            $tplayer->delete();
          }
        } else {
          $tplayermulmed = $this->T_playertickers->new_object();
          $tplayermulmed->PlayerId = $player->PlayerId;
          $tplayermulmed->PlayerName = $mplayerticker->get_M_Player()->Name;
          $tplayermulmed->TickerId = $player->TickerId;
          $tplayermulmed->TickerContent = $player->TickerContent;
          $tplayermulmed->TickerName = $player->TickerName;
          $tplayermulmed->IsDeleted = $player->IsDeleted;
          $tplayermulmed->ActiveDate = $player->ActiveDate;
          $tplayermulmed->InactiveDate = $player->InactiveDate;
          $tplayermulmed->TimeStart = $player->TimeStart;
          $tplayermulmed->TimeEnd = $player->TimeEnd;
          $tplayermulmed->save();
        }

        $mplayerticker->IsUpdated = 0;
        $mplayerticker->save();
      }
    }
  }

  private function updateMultimediaByPlayerMultimedia($playermultimediaid){
    $params = array(
      'where' => array(
        'Id' => $playermultimediaid
      )
    );
    $mplayermulmed = $this->M_playermultimedias->get(null, null, $params);
    if($mplayermulmed){
      $mplayermulmed->IsUpdated = 0;
      $mplayermulmed->save();
      return true;
    }
    return false;
  }

  private function updateTickerByPlayerTicker($playertickerid){
    $params = array(
      'where' => array(
        'Id' => $playertickerid
      )
    );
    $mplayerticker = $this->M_playertickers->get(null, null, $params);
    if($mplayerticker){
      $mplayerticker->IsUpdated = 0;
      $mplayerticker->save();
      return true;
    }
    return false;
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