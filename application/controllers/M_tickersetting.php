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
            load_view('m_tickersetting/index', array(), lang("ui_tickersetting"));
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
            load_view('m_tickersetting/add', $data, lang("ui_tickersetting"));  
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
            load_view('m_tickersetting/add', $data, lang("ui_tickersetting"));   
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
            load_view('m_tickersetting/edit', $data, lang("ui_tickersetting"));  
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
            load_view('m_tickersetting/edit', $data, lang("ui_tickersetting"));   
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
        $uploadpath = '/uploads/smartdisplay/'.$path.'/';

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

    public function getAllData(){

        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$form['m_tickersetting'],'Read'))
        {
            
            $datatable = $this->datatables->addEntity('M_tickersettings');
            $datatable
            ->addDtRowId('Id')
            ->addDtRowClass('rowdetail')
            ->addColumn(
                'Name', 
                function($row){
                    $url = base_url("mtickersetting/edit/{$row->Id}");
                    return "<a href = '{$url}' class = 'text-muted' >{$row->Name}</a>";
                }
            )->addColumn(
                'BackGroundColor', 
                function($row){
                    return "<div class='progress'>
                    <div style='width: 100%; background: {$row->BackGroundColor}' aria-valuemax='100' aria-valuemin='0' aria-valuenow='60' role='progressbar' class='red progress-bar'>
                   
                   </div>
                </div>";
                }
            )->addColumn(
                'FontColor', 
                function($row){
                    return "<div class='progress'>
                    <div style='width: 100%; background: {$row->FontColor}' aria-valuemax='100' aria-valuemin='0' aria-valuenow='60' role='progressbar' class='red progress-bar'>
                   
                   </div>
                </div>";
                }
            )->addColumn(
                'Height', 
                function($row){
                    return $row->Height;
                }
            
            )->addColumn(
                'IsActive', 
                function($row){
                    if($row->IsActive)
                        return "<a><i class='fa fa-check'></i></a>";
                    else
                        return "<td><a><i class='fa fa-close'></i></a>";
                }
            )->addColumn(
                'Height', 
                function($row){
                    return $row->Height;
                }
            )->addColumn(
                'Action', 
                function($row){
                    $btnclass = "";
                    if(!$row->IsActive)  
                        $btnclass = "text-danger";

                    return "<a href='#' class='$btnclass btn-just-icon link-action activate'><i class='fa fa-plug'></i></a>";
  
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