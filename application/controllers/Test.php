<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Test extends CI_Controller
{
    public function index(){
        $mastermenu = $this->M_forms->get_data_by_classname("Master");
        foreach($mastermenu as $master) {
            if(is_permitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$master->FormName, "Read")){
                echo "a";
            } else {
                echo "b";
            }
        }

    }
}