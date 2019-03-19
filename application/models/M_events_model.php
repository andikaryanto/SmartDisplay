<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_events_model extends MY_Model {

    public function __construct(){
        parent::__construct();
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
        
        return $warning;
    }

}

class M_event_object extends Model_object {
   
    public function setTimeStart($time = null){
        if(empty($time))
            $this->TimeStart = "00:00";
        else 
            $this->TimeStart = $time;
    }

    public function setTimeEnd($time = null){
        if(empty($time))
            $this->TimeEnd = "23:59";
        else 
            $this->TimeEnd = $time;

    }

}