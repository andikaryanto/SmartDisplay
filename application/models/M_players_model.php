<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_players_model extends MY_Model {

    public function __construct(){
        parent::__construct();
    }

    public function slotLeft(){
        $existPlayerCount = $this->count();
        $slots = $this->M_playerslots->get(1)->Count;
        return $slots - $existPlayerCount;
    }

    public function is_data_exist($name = null)
    {
        $exist = false;
        if($this->count(array('Name'=> $name)) > 0){
            $exist = true;
        }
        return $exist;
    }

    public function validate($model, $oldmodel = null, $isOnCreate = false)
    {
        $nameexist = false;
        $warning = array();
        if($isOnCreate){
            $existPlayerCount = $this->count();
            $slots = $this->M_playerslots->get(1)->Count;
            if($existPlayerCount >= $slots){
                $warning = array_merge($warning, array(0=>'err_msg_no_player_slots_left'));
            }
        } else {
            if(!empty($oldmodel))
            {
                if($model->Name != $oldmodel->Name)
                {
                    $nameexist = $this->is_data_exist($model->Name);
                }
            }
            else{
                if(!empty($model->Name))
                {
                    $nameexist = $this->is_data_exist($model->Name);
                }
                else{
                    $warning = array_merge($warning, array(0=>'ui_msg_name_can_not_null'));
                }
            }
            if($nameexist)
            {
                $warning = array_merge($warning, array(0=>'err_msg_name_exist'));
            }
        }
        
        return $warning;
    }

}

class M_player_object extends Model_object {
   
    public function isExistInMultimedia($multimediaId){
        $ci =& get_instance();
        $result = $ci->db->where('M_Multimedia_Id', $multimediaId)
                ->where('M_Player_Id', $this->Id)
                ->get('m_multimediadetails')
                ->row();
        if($result)
            return true;
        return false;

    }

    public function isExistInTicker($tickerId){
        $ci =& get_instance();
        $result = $ci->db->where('M_Ticker_Id', $tickerId)
                ->where('M_Player_Id', $this->Id)
                ->get('m_tickerdetails')
                ->row();
        if($result)
            return true;
        return false;

    }

}