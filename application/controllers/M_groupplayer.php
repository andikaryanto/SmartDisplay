<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_groupplayer extends CI_Controller {

    public function __construct()
    {
        parent::__construct(); 
        $this->paging->is_session_set();
    }

    public function index()
    {
        // your index goes here
        $form = $this->paging->get_form_name_id();
        if(is_permitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$form['m_groupplayer'],'Read'))
        {
            // $datapages = $this->M_groupplayers->get_list();
            // $data['model'] = $datapages;
            load_view('m_groupplayer/index', array(), lang("ui_groupplayer"));
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
            load_view('m_groupplayer/add', $data, lang("ui_groupplayer"));  
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
            load_view('m_groupplayer/add', $data, lang("ui_groupplayer"));   
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
            load_view('m_groupplayer/edit', $data, lang("ui_groupplayer"));  
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
            load_view('m_groupplayer/edit', $data, lang("ui_groupplayer"));   
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

    public function getAllData(){

        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$form['m_groupuser'],'Read'))
        {
            
            $datatable = $this->datatables->addEntity('M_groupplayers');
            $datatable
            ->addDtRowId('Id')
            ->addDtRowClass('rowdetail')
            ->addColumn(
                'GroupName', 
                function($row){
                    $url = base_url("mgroupplayer/edit/{$row->Id}");
                    return "<a href = '{$url}' class = 'text-muted' >{$row->GroupName}</a>";
                }
            )->addColumn(
                'Description', 
                function($row){
                    return $row->Description;
                }
            )->addColumn(
                'Created', 
                function($row){
                    return $row->Created;
                },
                false
            )->addColumn(
                'Action', 
                function($row){
                    $langrole = lang('Form.role');
                    return 
                        "<a href = '#' class = 'btn-just-icon link-action delete'><i class='fa fa-trash' rel = 'tooltip' title='lang('Form.delete')' ></i></a>";
                        
  
                },
                false,
                false
            );

            echo json_encode($datatable->populate());
        }
        else
        {
            
            $this->load->view('error/forbidden');
        } 
    }

}