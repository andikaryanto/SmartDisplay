<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_tickersetting extends CI_Controller {

    public function __construct()
    {
        parent::__construct(); 
        $this->paging->is_session_set();
    }

    public function index()
    {
        // your index goes here
        $form = $this->paging->get_form_name_id();
        if(is_permitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$form['m_tickersetting'],'Read'))
        {
            $datapages = $this->M_tickersettings->get_list();
            $data['model'] = $datapages;
            load_view('m_tickersetting/index', $data);
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
        if(is_permitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$form['m_tickersetting'],'Write'))
        {
            $model = $this->M_tickersettings->new_object();
            $model->BackGroundColor = "#00cc66";
            $model->FontColor = "#000002";
            $data =  $this->paging->set_data_page_add($model);
            load_view('m_tickersetting/add', $data);  
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
        $backgroundcolor = $this->input->post('backgroundcolor');
        $fontcolor = $this->input->post('fontcolor');
        $height = $this->input->post('height');
        $speed = $this->input->post('speed');
        
        $model = $this->M_tickersettings->new_object();
        $model->Name = $name;
        $model->BackGroundColor = $backgroundcolor;
        $model->FontColor = $fontcolor;
        $model->Height = $height;
        $model->IsActive = 0;
        $model->Speed = $speed;
        $model->CreatedBy = $_SESSION[get_variable().'userdata']['Username'];

        $validate = $this->M_tickersettings->validate($model);
 
        if($validate)
        {
            $this->session->set_flashdata('add_warning_msg',$validate);
            $data =  $this->paging->set_data_page_add($model);
            load_view('m_tickersetting/add', $data);   
        }
        else{
            $url = $this->upload($_FILES['file'], null, 'tickers');
            $model->ImgUrl = $url;
            $model->save();
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('mtickersetting/add');
        }
    }

    public function edit($id)
    {   
        // your edit method goes here
        $form = $this->paging->get_form_name_id();
        if(is_permitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$form['m_tickersetting'],'Write'))
        {
            $model = $this->M_tickersettings->get($id);
            $data =  $this->paging->set_data_page_edit($model);
            load_view('m_tickersetting/edit', $data);  
        }
        else
        {
            $this->load->view('forbidden/forbidden');
        } 
    }

    public function editsave()
    {   
        // your editsave method goes here
        $id = $this->input->post('idtickersetting');
        $name = $this->input->post('named');
        $backgroundcolor = $this->input->post('backgroundcolor');
        $fontcolor = $this->input->post('fontcolor');
        $height = $this->input->post('height');
        $speed = $this->input->post('speed');
        
        $model = $this->M_tickersettings->get($id);
        $oldmodel = clone $model;
        $model->Name = $name;
        $model->BackGroundColor = $backgroundcolor;
        $model->FontColor = $fontcolor;
        $model->Height = $height;
        $model->Speed = $speed;
        $model->ModifiedBy = $_SESSION[get_variable().'userdata']['Username'];
        //echo json_encode($model);

        $validate = $this->M_tickersettings->validate($model, $oldmodel);
        if($validate)
        {
            $this->session->set_flashdata('edit_warning_msg',$validate);
            $data =  $this->paging->set_data_page_edit($model);
            load_view('m_tickersetting/edit', $data);   
        }
        else
        {
            if($_FILES['file']['name'] != ""){
                $url = $this->upload($_FILES['file'], $id, 'tickers', true);
                $model->ImgUrl = $url;
            }
            $model->save();
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('mtickersetting');
        }
    }

    public function delete(){
        // your delete method goes here
        $id = $this->input->post("id");
        $form = $this->paging->get_form_name_id();
        if(is_permitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$form['m_tickersetting'],'Delete'))
        {   
            $deleteData = $this->M_tickersettings->get($id);
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
            $photos = $this->M_tickersettings->get($id);
            if($photos)
                $this->ftp->delete_file($photos->ImgUrl);
        }

        $filename = get_current_date('Ymd_His')."_".$files['name'];
        $this->ftp->upload($files['tmp_name'], $uploadpath.$filename);
        $this->ftp->close();
        return $uploadpath.$filename;
    }

    public function activate($id)
    {
        $form = $this->paging->get_form_name_id();
        if(is_permitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$form['m_tickersetting'],'Write'))
        {
            $setting = $this->M_tickersettings->get($id);
            if($setting){
                if($setting->IsActive == 0){
                    $setting->IsActive = 1;
                    $setting->save();

                    $params = array(
                        'where' => array(
                            'Id !=' => $id
                        )
                    );
                    $list = $this->M_tickersettings->get_list(null, null, $params);
                    foreach($list as $set){
                        $set->IsActive = 0;
                        $set->save();
                    }
                }
            }
            redirect('mtickersetting');
        }
        else
        {   
            $this->load->view('forbidden/forbidden');
        }   
    }

}