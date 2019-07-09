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
            load_view('m_event/index', array(), lang('ui_even'));
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
            load_view('m_event/add', $data, lang('ui_even'));  
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
            load_view('m_event/add', $data, lang('ui_even'));   
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
            load_view('m_event/edit', $data, lang('ui_even'));  
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
            load_view('m_event/edit', $data, lang('ui_even'));   
        }
        else
        {
            $model->save();
            $this->updateMplayermultimedia($model);
            $this->updateMplayerticker($model);
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

    private function updateMplayerticker($model){
        foreach($model->get_list_M_Ticker() as $ticker){
            foreach($ticker->get_list_M_Tickerdetail() as $detail){
                foreach($detail->get_list_M_Playerticker() as $playeticker){
                    $playeticker->IsUpdated = 1;
                    $playeticker->save();
                }
            }
        }

    }

    public function getAllData(){

        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$form['m_multimedia'],'Read'))
        {
            
            $datatable = $this->datatables->addEntity('M_events');
            $datatable
            ->addDtRowId('Id')
            ->addDtRowClass('rowdetail')
            ->addColumn(
                'Name', 
                function($row){
                    $url = base_url("mevent/edit/{$row->Id}");
                    return "<a href = '{$url}' class = 'text-muted' >{$row->Name}</a>";
                }
            )->addColumn(
                'Description', 
                function($row){
                    return $row->Description;
                }
            )->addColumn(
                'ActiveDate', 
                function($row){
                    return get_formated_date($row->ActiveDate, "d M y");
                }
            )->addColumn(
                'InactiveDate', 
                function($row){
                    return get_formated_date($row->InactiveDate, "d M y");
                }    
            )->addColumn(
                'TimeStart', 
                function($row){
                    return $row->TimeStart;
                }    
            )->addColumn(
                'TimeEnd', 
                function($row){
                    return $row->TimeEnd;
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
                        "<a href='#' rel='tooltip' title='lang('ui_delete')' class='btn-just-icon link-action delete'><i class='fa fa-trash'></i></a>";
                        
  
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