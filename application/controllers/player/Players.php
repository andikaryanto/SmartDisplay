<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Players extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->database('natureuser', TRUE);
        //$this->load->model(array('M_players','M_players', 'G_languages', 'G_colors', 'M_playersettings'));
        // $this->paging->is_session_set();
    }

    public function index($playername){
        $params = array(
            'where' => array(
                'Name' => $playername,
                'IsRegistered' => 1
            )
        );
        $player = $this->M_players->get(null, null, $params);
        if($player){
            $tickerdata="";
            $datas = array();
            $params = array(
                'where' =>array (
                    'PlayerName' => $player->Name 
                )
            );

            $model = $this->T_playermultimedias->get_list(null, null,$params);
            $tickers = $this->T_playertickers->get_list(null, null,$params);
            foreach($model as $playermulmed){
                $currentdate = get_current_datetime();
                $activedate = get_datetime(get_formated_date($playermulmed->ActiveDate, 'Y-m-d'));
                $inactivedate = get_datetime(get_formated_date($playermulmed->InactiveDate, 'Y-m-d'), 23,59,59);
                if($currentdate >= $activedate && $currentdate <= $inactivedate){
                    if (time() >= strtotime($playermulmed->TimeStart) && time() <= strtotime($playermulmed->TimeEnd)) {
                        array_push($datas, $playermulmed);
                    }
                }
            }
            foreach($tickers as $ticker){
                $tickerdata .= '<img class = "imgRunning" src="'.base_url('resources/uploads/tickers/20190329_112710_img_358304.png').'"><div class = "textRunning">'.$ticker->TickerContent.'</div>';
            }

            $paramtickerset = array(
                'where' => array(
                    'IsActive' => 1
                )
            );
            $tickerset = $this->M_tickersettings->get(null, null, $paramtickerset);

            $data['playerId'] = $player->Id;
            $data['playerName'] = $player->Name;
            $data['model'] = $datas;
            $data['ticker'] = $tickerdata;
            $data['tickersetting'] = $tickerset;
            $this->load->view('player/player', $data);  
        } else {
            $this->load->view('forbidden/playernotfound');  
        }
        // 

    }

    

    public function register(){
        $this->load->view('player/register');  
    }
    
}