<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_groupplayers_model extends MY_Model {

    public function __construct(){
        parent::__construct();
    }

    public function is_data_exist($groupname = null)
    {
        $exist = false;
        if($this->count(array('GroupName'=> $groupname)) > 0){
            $exist = true;
        }
        return $exist;
    }

    public function validate($model, $oldmodel = null)
    {
        $nameexist = false;
        $warning = array();
        if(!empty($oldmodel))
        {
            if($model->GroupName != $oldmodel->GroupName)
            {
                $nameexist = $this->is_data_exist($model->GroupName);
            }
        }
        else{
            if(!empty($model->GroupName))
            {
                $nameexist = $this->is_data_exist($model->GroupName);
            }
            else{
                $warning = array_merge($warning, array(0=>'ui_msg_group_name_can_not_null'));
            }
        }
        if($nameexist)
        {
            $warning = array_merge($warning, array(0=>'err_msg_name_exist'));
        }
        
        return $warning;
    }

}

class M_groupplayer_object extends Model_object {

    public function isExistInMultimedia($multimediaId){
        $ci =& get_instance();
        $result = $ci->db->where('M_Multimedia_Id', $multimediaId)
                ->where('M_Groupplayer_Id', $this->Id)
                ->get('m_multimediadetails')
                ->row();
        if($result)
            return true;
        return false;

    }

    public function isExistInTicker($tickerId){
        $ci =& get_instance();
        $result = $ci->db->where('M_Ticker_Id', $tickerId)
                ->where('M_Groupplayer_Id', $this->Id)
                ->get('m_tickerdetails')
                ->row();
        if($result)
            return true;
        return false;

    }
}