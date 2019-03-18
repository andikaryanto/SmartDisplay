<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_groupplayer extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        // your index goes here
        $form = $this->paging->get_form_name_id();
        if(is_permitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$form['m_groupplayer'],'Read'))
        {
            $datapages = $this->M_groupplayers->get_list();
            $data['model'] = $datapages;
            load_view('m_groupplayer/index', $data);
        }
        else
        {   
            $this->load->view('forbidden/forbidden');
        }
    }

    public function add()
    {   
        // your add method goes here
        $form = $this->paging->get_form_name_id();
        if(is_permitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$form['m_groupplayer'],'Write'))
        {
            $model = $this->M_groupplayers->new_object();
            $data =  $this->paging->set_data_page_add($model);
            load_view('m_groupplayer/add', $data);  
        }
        else
        {
            $this->load->view('forbidden/forbidden');
        }
    }

    public function addsave()
    {   
        // your addsave method goes here
        $name = $this->input->post('named');
        $description = $this->input->post('description');
        
        $model = $this->M_groupplayers->new_object();
        $model->GroupName = $name;
        $model->Description = $description;
        $model->CreatedBy = $_SESSION[get_variable().'userdata']['Username'];

        $validate = $this->M_groupplayers->validate($model);
 
        if($validate)
        {
            $this->session->set_flashdata('add_warning_msg',$validate);
            $data =  $this->paging->set_data_page_add($model);
            load_view('m_groupplayer/add', $data);   
        }
        else{
    
            $model->save();
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('mgroupplayer/add');
        }
    }

    public function edit($id)
    {   
        // your edit method goes here
        $form = $this->paging->get_form_name_id();
        if(is_permitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$form['m_groupplayer'],'Write'))
        {
            $model = $this->M_groupplayers->get($id);
            $data =  $this->paging->set_data_page_edit($model);
            load_view('m_groupplayer/edit', $data);  
        }
        else
        {
            $this->load->view('forbidden/forbidden');
        } 
    }

    public function editsave()
    {   
        // your editsave method goes here
        $id = $this->input->post('idgroupplayer');
        $name = $this->input->post('named');
        $description = $this->input->post('description');

        $model = $this->M_groupplayers->get($id);
        $oldmodel = clone $model;
        $model->GroupName = $name;
        $model->Description = $description;
        $model->ModifiedBy = $_SESSION[get_variable().'userdata']['Username'];
        //echo json_encode($model);

        $validate = $this->M_groupplayers->validate($model, $oldmodel);
        if($validate)
        {
            $this->session->set_flashdata('edit_warning_msg',$validate);
            $data =  $this->paging->set_data_page_edit($model);
            load_view('m_groupplayer/edit', $data);   
        }
        else
        {
            $model->save();
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('mgroupplayer');
        }
    }

    public function delete(){
        // your delete method goes here
        $id = $this->input->post("id");
        $form = $this->paging->get_form_name_id();
        if(is_permitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$form['m_groupplayer'],'Delete'))
        {   
            $deleteData = $this->M_groupplayers->get($id);
            $delete = $deleteData->delete();
            if(isset($delete)){
                $deletemsg = $this->helpers->get_query_error_message($delete['code']);
                //$this->session->set_flashdata('warning_msg', $deletemsg);
                echo json_encode(delete_status($deletemsg, FALSE));
            } else {
                $deletemsg = $this->paging->get_delete_message();
                //$this->session->set_flashdata('delete_msg', $deletemsg);
                echo json_encode(delete_status($deletemsg));
            }
        } else {
            echo json_encode(delete_status("", FALSE, TRUE));
        }

    }

}