<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_forms_model extends MY_Model {

    public function __construct(){
        parent::__construct();
    }

    public function get_alldata(){
        // get all data
        $query = $this->db->get('m_forms');
        return $query->result();
    }

    public function get_data_by_id($id){  
        // get data by primary key
    }

    public function get_data_by_classname($className){  
        // get data by primary key
        $notId = array(1,2,3,4,5,6,8);

        $this->db->where('ClassName', $className);
        $this->db->where_not_in('Id', $notId);
        return $this->get_list();
    }

    public function get_data_by_formname($formname){  
        // get data by primary key
        $param = array(
            'where' => array(
                "FormName" => $formname
            )
        );
        return $this->get_list(null, null, $param)[0];
    }

    public function get_datapages($page, $pagesize, $search = null){  
        // your datapages
    }

    public function save_data($data){  
        // your save data
    }

    public function edit_data($data){  
        // your edit data
    }

    public function delete_data($id){
        // delete data
    }

    public function create_object(){
        // create object goes here
        $data = array(
        );
        return $data;
    }

    public function create_object_tabel(){
        //create object goes here
        $data = array(
        );
        return $data;
    }

    public function validate($model, $oldmodel = null){
        //validate goes here
    }

    public function set_resources(){
        // resource language goes here
    }
}

class M_form_object extends Model_object {
	
	
}