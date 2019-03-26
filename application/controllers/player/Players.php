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
        $this->load->view('player/player');  

    }

    public function register(){
        $this->load->view('player/register');  
    }

    public function getMultimediaByPlayer($player){
        
    }
    
}