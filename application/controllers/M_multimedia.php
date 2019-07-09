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
            load_view('m_multimedia/index', array(), lang("ui_multimedia"));
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
            load_view('m_multimedia/add', $data, lang("ui_multimedia"));  
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
        $showtime = $this->input->post('showtime');

        
        
        $model = $this->M_multimedias->new_object();
        $model->M_Event_Id = $eventid;
        $model->Name = $name;
        $model->Type = $type;
        $model->AssignType = $assigntype;
        $model->IsDeleted = 0;
        $model->ShowTime = $showtime;
        $model->CreatedBy = $_SESSION[get_variable().'userdata']['Username'];

        $validate = $this->M_multimedias->validate($model);
        if($validate)
        {
            $this->session->set_flashdata('add_warning_msg',$validate);
            $data =  $this->paging->set_data_page_add($model);
            load_view('m_multimedia/add', $data, lang("ui_multimedia"));   
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
            load_view('m_multimedia/edit', $data, lang("ui_multimedia"));  
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
        $eventid = $this->input->post('eventid');
        $type = $this->input->post('type');
        $assigntype = $this->input->post('assigntype');
        $showtime = $this->input->post('showtime');

        $model = $this->M_multimedias->get($id);
        $oldmodel = clone $model;

        $model->M_Event_Id = $eventid;
        $model->Name = $name;
        $model->Type = $type;
        $model->AssignType = $assigntype;
        $model->ShowTime = $showtime;
        
        $model->ModifiedBy = $_SESSION[get_variable().'userdata']['Username'];
        //echo json_encode($model);

        $validate = $this->M_multimedias->validate($model, $oldmodel);
        if($validate)
        {
            $this->session->set_flashdata('edit_warning_msg',$validate);
            $data =  $this->paging->set_data_page_edit($model);
            load_view('m_multimedia/edit', $data, lang("ui_multimedia"));   
        }
        else
        {
            if($_FILES['file']['name'] != ""){
                $url = $this->upload($_FILES['file'], $model->Id, $type == 1 ? 'images' : 'videos');
                $model->Url = $url;
            }

            $model->save();
            $players = array();
            foreach($model->get_list_M_Multimediadetail() as $detail){
                if($model->AssignType == 1)
                    array_push($players, $detail->M_Player_Id);
                else 
                array_push($players, $detail->M_Groupplayer_Id);
            }
            $this->doSaveDetail($model->Id, $model->AssignType, $players);
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
            $deleteData->IsDeleted = 1;
            $deleteData->save();
            foreach($deleteData->get_list_M_Multimediadetail() as $detail){
                $detail->IsUpdated = 1;
                $detail->save();
            }

            $deletemsg = $this->helpers->get_query_error_message($delete['code']);
            //$this->session->set_flashdata('warning_msg', $deletemsg);
            echo json_encode(delete_status($deletemsg, FALSE));
        } else {
            echo json_encode(delete_status("", FALSE, TRUE));
        }

    }

    private function upload($files, $id = null, $path = null, $isedit = false){
        $config = fileconfig_ftp();
        $uploadpath = '/uploads/smartdisplay/'.$path.'/';

        $this->ftp->connect($config);
        if($isedit){
            $photos = $this->M_multiledias->get($id);
            if($photos){
                $this->ftp->delete_file($photo->Path);
            }
        }

        $filename = get_current_date('Ymd_His')."_".$files['name'];
        $this->ftp->upload($files['tmp_name'], $uploadpath.$filename);
        $this->ftp->close();
        return $uploadpath.$filename;
    }

    
    public function adddetailplayer(){
        $idmultimedia = $_GET['idmultimedia'];
        $assigntype = $_GET['assigntype'];
        $idplayergroup = array();
        if(isset($_GET['idplayergroup']))
            $idplayergroup = json_decode($_GET['idplayergroup']);

        $arrunsaved = array();
        foreach($idplayergroup as $iddetail){

            // $detailsub = $this->M_multimediadetails->get($iddetail);
            // if(!$detailsub){
                $unsaveddetail = $this->M_multimediadetails->new_object();
                $unsaveddetail->M_Multimedia_Id = $idmultimedia;
                if($assigntype == 1){
                    $unsaveddetail->M_Player_Id = $iddetail;
                    $unsaveddetail->PlayerName = $unsaveddetail->get_M_Player()->Name;
                }
                else {
                    $unsaveddetail->M_Groupplayer_Id = $iddetail;
                    $unsaveddetail->PlayerName = $unsaveddetail->get_M_Groupplayer()->GroupName;
                }

                $unsaveddetail->IsUpdated = 0;
                $unsaveddetail->CreatedBy = $_SESSION[get_variable().'userdata']['Username'];
                array_push($arrunsaved, $unsaveddetail);
            // } else {
            //     continue;
            // }
        }

        $multimedia = $this->M_multimedias->get($idmultimedia);
        $detaildata = $multimedia->get_list_M_Multimediadetail();
        if($detaildata){
            foreach($detaildata as $detailmultimedia){
                if($detailmultimedia->IsDeleted == 0){
                    if($assigntype == 1){
                        $detailmultimedia->PlayerName = $detailmultimedia->get_M_Player()->Name;
                    }
                    else {
                        $detailmultimedia->PlayerName = $detailmultimedia->get_M_Groupplayer()->GroupName;
                    }
                    array_push($arrunsaved, $detailmultimedia);
                }
            }
        }
        $data = array('data' => 
            $arrunsaved
        );
        //echo $unsaveddetail->getDaysFine();
        echo json_encode($data);
    }

    public function saveDetail(){
        $multimediaId = $this->input->post('multimediaId');
        $assigntype = $this->input->post('assigntype');
        $idplayergroup = $this->input->post('idplayergroup');

        $players = json_decode($idplayergroup);
        $this->doSaveDetail($multimediaId, $assigntype, $players, true);
        
    }

    private function doSaveDetail($multimediaId, $assigntype, $players, $isNewData = false){
        $field = "";
        $newdetailid = 0;
        foreach($players as $playerid){

            if($assigntype == 1){
                $field = "M_Player_Id";
            } else {
                $field = "M_Groupplayer_Id";
            }
            //savedatail
            $params = array(
                'where' => array(
                    'M_Multimedia_Id' => $multimediaId,
                    $field => $playerid,
                    'IsDeleted' => 0
                )
            );

            $detail = $this->M_multimediadetails->get(null, null, $params);
            if($detail){
                $newdetailid = $detail->Id;
            } else {
                $newmodel = $this->M_multimediadetails->new_object();
                $newmodel->M_Multimedia_Id =  $multimediaId;
                $newmodel->$field = $playerid;
                $newmodel->IsDeleted = 0;
                $newdetailid = $newmodel->save();
            }

            //save player
            if($isNewData){
                if($newdetailid > 0){
                    if($assigntype == 1){
                        $playermultimedia = $this->M_playermultimedias->new_object();
                        $playermultimedia->M_Multimediadetail_Id = $newdetailid;
                        $playermultimedia->M_Player_Id = $playerid;
                        $playermultimedia->IsUpdated = 1;
                        $playermultimedia->save();
                    } else {
                        $groupplayermodel = $this->M_groupplayers->get($playerid);
                        if($groupplayermodel){
                            $players = $groupplayermodel->get_list_M_Player();
                            if($players){
                                foreach($players as $player){
                                    $playermultimedia = $this->M_playermultimedias->new_object();
                                    $playermultimedia->M_Multimediadetail_Id = $newdetailid;
                                    $playermultimedia->M_Player_Id = $player->Id;
                                    $playermultimedia->IsUpdated = 1;
                                    $playermultimedia->save();
                                }
                            }
                        }
                    }
                }
            } else {
                $params = array(
                    'where' => array(
                         'M_Multimediadetail_Id' => $newdetailid
                    )
                );

                $players = $this->M_playermultimedias->get_list(null, null, $params);
                foreach($players as $player){
                    $player->IsUpdated = 1;
                    $player->save();
                }
            }

        }

        echo "success";
    }

    public function deleteDetail(){
        $detailid = $this->input->post('id');
        $model = $this->M_multimediadetails->get($detailid);
        if($model){
            $model->IsDeleted = 1;
            $model->save();
            foreach($model->get_list_M_Playermultimedia() as $playermulmed){
                $playermulmed->IsUpdated = 1;
                $playermulmed->save();
            }
        }
        
        echo "success";

    }

    public function deleteAllPlayer(){
        $multimediaid = $this->input->post('multimediaid');
        $params = array(
            'where' => array(
                'M_Multimedia_Id' =>$multimediaid 
            )
        );

        $models = $this->M_multimediadetails->get_list(null, null, $params);

        foreach($models as $model){
            $model->IsDeleted = 1;
            $model->save();
            foreach($model->get_list_M_Playermultimedia() as $playermulmed){
                $playermulmed->IsUpdated = 1;
                $playermulmed->save();
            }
        }
        echo "success";
    }

    public function getAllData(){

        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$form['m_multimedia'],'Read'))
        {
            
            $datatable = $this->datatables->addEntity('M_multimedias');
            $datatable
            ->addDtRowId('Id')
            ->addDtRowClass('rowdetail')
            ->addColumn(
                'Name', 
                function($row){
                    $url = base_url("mmultimedia/edit/{$row->Id}");
                    return "<a href = '{$url}' class = 'text-muted' >{$row->Name}</a>";
                }
            )->addColumn(
                '', 
                function($row){
                    return $row->get_M_Event()->Name;
                }
            )->addColumn(
                '', 
                function($row){
                    return getEnumName("MultimediaType", $row->Type);
                }
            )->addColumn(
                '', 
                function($row){
                    return getEnumName("MultimediaAssignType", $row->AssignType);
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