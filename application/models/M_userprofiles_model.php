<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_userprofiles_model extends MY_Model {

    public function __construct(){
        parent::__construct();
    }

    public function validate($model, $oldmodel = null){
        //validate goes here
    }

}

class M_userprofile_object extends Model_object {
   
}