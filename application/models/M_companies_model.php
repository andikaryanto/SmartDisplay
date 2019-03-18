<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_companies_model extends MY_Model {

    public function __construct(){
        parent::__construct();
    }

    public function validate($oldmodel = null){
        //validate goes here
    }

}

class M_company_object extends Model_object {
   
}