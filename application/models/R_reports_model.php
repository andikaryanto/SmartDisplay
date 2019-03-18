<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class R_reports_model extends MY_Model {

    public function __construct(){
        parent::__construct();
    }

    public function get_data_by_name($reportname){  
        // get data by primary key
        $param = array(
            'where' => array(
                "Name" => $reportname
            )
        );
        return $this->get_list(null, null, $param)[0];
    }

    public function validate($model, $oldmodel = null){
        //validate goes here
    }

}

class R_report_object extends Model_object {
   
}