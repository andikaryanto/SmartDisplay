<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_event extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->database('naturedisaster', TRUE);
        //$this->load->model(array('M_events','M_accessroles')); 
        $this->paging->is_session_set();
    }

    public function index()
    {
        $form = $this->paging->get_form_name_id();
        if(is_permitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$form['m_event'],'Read'))
        {
            $model = $this->M_events->get_list();
            $data['model'] = $model;
            load_view('m_event/index', $data);
        }
        else
        {   
            $this->load->view('forbidden/forbidden');
        }
    }
    
    public function add()
    {
        // echo $_GET['param'];
        $form = $this->paging->get_form_name_id();
        if(is_permitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$form['m_event'],'Write'))
        {
            $model = $this->M_events->new_object();
            $model->ActiveDate = get_current_date('d-m-Y');
            $model->InactiveDate = get_current_date('d-m-Y');
            $model->TimeStart = "00:00";
            $model->TimeEnd = "23:59";
            $data =  $this->paging->set_data_page_add($model);
            load_view('m_event/add', $data);  
        }
        else
        {
            $this->load->view('forbidden/forbidden');
        }
    }

    public function addsave()
    {
        //$date = new DateTime();
        $warning = array();
        $err_exist = false;
        $name = $this->input->post('named');
        $activedate = $this->input->post('activedate');
        $inactivedate = $this->input->post('inactivedate');
        $timestart = $this->input->post('timestart');
        $timeend = $this->input->post('timeend');
        $description = $this->input->post('description');
        
        $model = $this->M_events->new_object();
        $model->Name = $name;
        $model->ActiveDate = get_formated_date($activedate);
        $model->InactiveDate = get_formated_date($inactivedate);
        $model->setTimeStart($timestart);
        $model->setTimeEnd($timeend);
        $model->Description = $description;
        $model->CreatedBy = $_SESSION[get_variable().'userdata']['Username'];

        $validate = $this->M_events->validate($model);
 
        if($validate)
        {
            $this->session->set_flashdata('add_warning_msg',$validate);
            $data =  $this->paging->set_data_page_add($model);
            load_view('m_event/add', $data);   
        }
        else{
    
            $model->save();
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('mevent/add');
        }
    }

    public function edit($id)
    {
        $form = $this->paging->get_form_name_id();
        if(is_permitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$form['m_event'],'Write'))
        {
            $model = $this->M_events->get($id);
            $model->ActiveDate = get_formated_date($model->ActiveDate, 'd-m-Y');
            $model->InactiveDate = get_formated_date($model->InactiveDate, 'd-m-Y');
            $data =  $this->paging->set_data_page_edit($model);
            load_view('m_event/edit', $data);  
        }
        else
        {
            $this->load->view('forbidden/forbidden');
        } 
    }

    public function editsave()
    {
        
        $id = $this->input->post('idevent');
        $name = $this->input->post('named');
        $activedate = $this->input->post('activedate');
        $inactivedate = $this->input->post('inactivedate');
        $timestart = $this->input->post('timestart');
        $timeend = $this->input->post('timeend');
        $description = $this->input->post('description');

        $model = $this->M_events->get($id);
        $oldmodel = clone $model;

        $model->Name = $name;
        $model->ActiveDate = get_formated_date($activedate);
        $model->InactiveDate = get_formated_date($inactivedate);
        $model->setTimeStart($timestart);
        $model->setTimeEnd($timeend);
        $model->Description = $description;
        $model->ModifiedBy = $_SESSION[get_variable().'userdata']['Username'];
        //echo json_encode($model);

        $validate = $this->M_events->validate($model, $oldmodel);
        if($validate)
        {
            $this->session->set_flashdata('edit_warning_msg',$validate);
            $data =  $this->paging->set_data_page_edit($model);
            load_view('m_event/edit', $data);   
        }
        else
        {
            $model->save();
            $this->updateMplayermultimedia($model);
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('mevent');
        }
    }

    public function delete(){
        $id = $this->input->post("id");
        $form = $this->paging->get_form_name_id();
        if(is_permitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$form['m_event'],'Delete'))
        {   
            $deleteData = $this->M_events->get($id);
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

    private function updateMplayermultimedia($model){
        foreach($model->get_list_M_Multimedia() as $multimedia){
            foreach($multimedia->get_list_M_Multimediadetail() as $detail){
                foreach($detail->get_list_M_Playermultimedia() as $playermulmed){
                    $playermulmed->IsUpdated = 1;
                    $playermulmed->save();
                }
            }
        }

    }
    
}