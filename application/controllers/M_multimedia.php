<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_multimedia extends CI_Controller {

    public function __construct()
    {
        parent::__construct(); 
        $this->paging->is_session_set();

    }

    public function index()
    {
        // your index goes here
        $form = $this->paging->get_form_name_id();
        if(is_permitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$form['m_multimedia'],'Read'))
        {
            $datapages = $this->M_multimedias->get_list();
            $data['model'] = $datapages;
            load_view('m_multimedia/index', $data);
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
        if(is_permitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$form['m_multimedia'],'Write'))
        {
            $model = $this->M_multimedias->new_object();
            $data =  $this->paging->set_data_page_add($model);
            load_view('m_multimedia/add', $data);  
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
        $eventid = $this->input->post('eventid');
        $type = $this->input->post('type');
        $assigntype = $this->input->post('assigntype');

        
        
        $model = $this->M_multimedias->new_object();
        $model->M_Event_Id = $eventid;
        $model->Name = $name;
        $model->Type = $type;
        $model->AssignType = $assigntype;
        $model->IsDeleted = 0;
        $model->CreatedBy = $_SESSION[get_variable().'userdata']['Username'];

        $validate = $this->M_multimedias->validate($model);
        if($validate)
        {
            $this->session->set_flashdata('add_warning_msg',$validate);
            $data =  $this->paging->set_data_page_add($model);
            load_view('m_multimedia/add', $data);   
        }
        else{
    
            $url = $this->upload($_FILES['file'], null, $type == 1 ? 'images' : 'videos');
            $model->Url = $url;
            $newid = $model->save();
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('mmultimedia/edit/'.$newid);
        }
    }

    public function edit($id)
    {   
        // your edit method goes here
        $form = $this->paging->get_form_name_id();
        if(is_permitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$form['m_multimedia'],'Write'))
        {
            $model = $this->M_multimedias->get($id);
            $data =  $this->paging->set_data_page_edit($model);
            load_view('m_multimedia/edit', $data);  
        }
        else
        {
            $this->load->view('forbidden/forbidden');
        } 
    }

    public function editsave()
    {   
        // your editsave method goes here
        $id = $this->input->post('idmultimedia');
        $name = $this->input->post('named');
        $description = $this->input->post('description');

        $model = $this->M_multimedias->get($id);
        $oldmodel = clone $model;
        $model->GroupName = $name;
        $model->Description = $description;
        $model->ModifiedBy = $_SESSION[get_variable().'userdata']['Username'];
        //echo json_encode($model);

        $validate = $this->M_multimedias->validate($model, $oldmodel);
        if($validate)
        {
            $this->session->set_flashdata('edit_warning_msg',$validate);
            $data =  $this->paging->set_data_page_edit($model);
            load_view('m_multimedia/edit', $data);   
        }
        else
        {
            $model->save();
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('mmultimedia');
        }
    }

    public function delete(){
        // your delete method goes here
        $id = $this->input->post("id");
        $form = $this->paging->get_form_name_id();
        if(is_permitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$form['m_multimedia'],'Delete'))
        {   
            $deleteData = $this->M_multimedias->get($id);
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

    private function upload($files, $id = null, $path = null, $isedit = false){
        $config = fileconfig_ftp();
        $uploadpath = '/uploads/'.$path.'/';

        $this->ftp->connect($config);
        if($isedit){
            $photos = $this->M_multiledias->get($id);
            if($photos)
                $this->ftp->delete_file($photo->Path);
        }

        $filename = get_current_date('Ymd_His')."_".$files['name'][0];
        $this->ftp->upload($files['tmp_name'][0], $uploadpath.$filename);
        $this->ftp->close();
        return $uploadpath.$filename;
    }

}