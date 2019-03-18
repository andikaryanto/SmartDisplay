<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_enum extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getEnumsDetailById(){
        $id = $this->input->post("id");
        $models = $this->M_enums->get_data_by_id($id);

        foreach($models as $model){
            $model->EnumName = lang($model->Resource);
        }

        $return = array(
            'model' => $models
        );

        echo json_encode($return);
    }
}