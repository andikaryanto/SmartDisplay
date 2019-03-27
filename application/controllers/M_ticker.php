<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_ticker extends CI_Controller {

    public function __construct()
    {
        parent::__construct(); 
        $this->paging->is_session_set();
    }

    public function index()
    {
        // your index goes here
        $form = $this->paging->get_form_name_id();
        if(is_permitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$form['m_ticker'],'Read'))
        {
            $datapages = $this->M_tickers->get_list();
            $data['model'] = $datapages;
            load_view('m_ticker/index', $data);
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
        if(is_permitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$form['m_ticker'],'Write'))
        {
            $model = $this->M_tickers->new_object();
            $data =  $this->paging->set_data_page_add($model);
            load_view('m_ticker/add', $data);  
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
        $description = $this->input->post('description');
        $assigntype = $this->input->post('assigntype');
        
        $model = $this->M_tickers->new_object();
        $model->Name = $name;
        $model->Description = $description;
        $model->M_Event_Id = $eventid;
        $model->AssignType = $assigntype;
        $model->IsDeleted = 0;
        $model->CreatedBy = $_SESSION[get_variable().'userdata']['Username'];

        // echo json_encode($model);
        $validate = $this->M_tickers->validate($model);
 
        if($validate)
        {
            $this->session->set_flashdata('add_warning_msg',$validate);
            $data =  $this->paging->set_data_page_add($model);
            load_view('m_ticker/add', $data);   
        }
        else{
    
            // echo json_encode($model);
            $newid = $model->save();
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('mticker/edit/'.$newid);
        }
    }

    public function edit($id)
    {   
        // your edit method goes here
        $form = $this->paging->get_form_name_id();
        if(is_permitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$form['m_ticker'],'Write'))
        {
            $model = $this->M_tickers->get($id);
            $data =  $this->paging->set_data_page_edit($model);
            load_view('m_ticker/edit', $data);  
        }
        else
        {
            $this->load->view('forbidden/forbidden');
        } 
    }

    public function editsave()
    {   
        // your editsave method goes here
        $id = $this->input->post('idticker');
        $name = $this->input->post('named');
        $eventid = $this->input->post('eventid');
        $description = $this->input->post('description');
        $assigntype = $this->input->post('assigntype');

        $model = $this->M_tickers->get($id);
        $oldmodel = clone $model;

        $model->Name = $name;
        $model->Description = $description;
        $model->M_Event_Id = $eventid;
        $model->AssignType = $assigntype;
        $model->ModifiedBy = $_SESSION[get_variable().'userdata']['Username'];
        //echo json_encode($model);

        $validate = $this->M_tickers->validate($model, $oldmodel);
        if($validate)
        {
            $this->session->set_flashdata('edit_warning_msg',$validate);
            $data =  $this->paging->set_data_page_edit($model);
            load_view('m_ticker/edit', $data);   
        }
        else
        {
            $model->save();
            $players = array();
            foreach($model->get_list_M_Tickerdetail() as $detail){
                if($model->AssignType == 1)
                    array_push($players, $detail->M_Player_Id);
                else 
                    array_push($players, $detail->M_Groupplayer_Id);

            }
            $this->doSaveDetail($model->Id, $model->AssignType, $players);
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('mticker');
        }
    }

    public function delete(){
        // your delete method goes here
        $id = $this->input->post("id");
        $form = $this->paging->get_form_name_id();
        if(is_permitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$form['m_ticker'],'Delete'))
        {   
            $deleteData = $this->M_tickers->get($id);
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

    public function adddetailplayer(){
        $idticker = $_GET['idticker'];
        $assigntype = $_GET['assigntype'];
        $idplayergroup = array();
        if(isset($_GET['idplayergroup']))
            $idplayergroup = json_decode($_GET['idplayergroup']);

        $arrunsaved = array();
        foreach($idplayergroup as $iddetail){

            // $detailsub = $this->M_tickerdetails->get($iddetail);
            // if(!$detailsub){
                $unsaveddetail = $this->M_tickerdetails->new_object();
                $unsaveddetail->M_Ticker_Id = $idticker;
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

        $ticker = $this->M_tickers->get($idticker);
        $detaildata = $ticker->get_list_M_Tickerdetail();
        if($detaildata){
            foreach($detaildata as $detailticker){
                if($assigntype == 1){
                    $detailticker->PlayerName = $detailticker->get_M_Player()->Name;
                }
                else {
                    $detailticker->PlayerName = $detailticker->get_M_Groupplayer()->GroupName;
                }
                array_push($arrunsaved, $detailticker);
            }
        }
        $data = array('data' => 
            $arrunsaved
        );
        //echo $unsaveddetail->getDaysFine();
        echo json_encode($data);
    }

    public function saveDetail(){
        $tickerId = $this->input->post('tickerId');
        $assigntype = $this->input->post('assigntype');
        $idplayergroup = $this->input->post('idplayergroup');

        $players = json_decode($idplayergroup);
        $this->doSaveDetail($tickerId, $assigntype, $players, true);
        
    }
    private function doSaveDetail($tickerId, $assigntype, $players, $isNewData = false){
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
                    'M_Ticker_Id' => $tickerId,
                    $field => $playerid,
                    'IsDeleted' => 0
                )
            );

            $detail = $this->M_tickerdetails->get(null, null, $params);
            // echo json_encode($detail);
            if($detail){
                $newdetailid = $detail->Id;
            } else {
                $newmodel = $this->M_tickerdetails->new_object();
                $newmodel->M_Ticker_Id =  $tickerId;
                $newmodel->$field = $playerid;
                $newmodel->IsDeleted = 0;
                $newdetailid = $newmodel->save();
            }

            //save player
            if($isNewData){
                if($newdetailid > 0){
                    if($assigntype == 1){
                        $playerticker = $this->M_playertickers->new_object();
                        $playerticker->M_Tickerdetail_Id = $newdetailid;
                        $playerticker->M_Player_Id = $playerid;
                        $playerticker->IsUpdated = 1;
                        $playerticker->save();
                    } else {
                        $groupplayermodel = $this->M_groupplayers->get($playerid);
                        if($groupplayermodel){
                            $players = $groupplayermodel->get_list_M_Player();
                            if($players){
                                foreach($players as $player){
                                    $playerticker = $this->M_playertickers->new_object();
                                    $playerticker->M_Tickerdetail_Id = $newdetailid;
                                    $playerticker->M_Player_Id = $player->Id;
                                    $playerticker->IsUpdated = 1;
                                    $playerticker->save();
                                }
                            }
                        }
                    }
                }
            } else {
                $params = array(
                    'where' => array(
                         'M_Tickerdetail_Id' => $newdetailid
                    )
                );

                $players = $this->M_playertickers->get_list(null, null, $params);
                echo json_encode($players);
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
        $model = $this->M_tickerdetails->get($detailid);
        if($model){
            $model->IsDeleted = 1;
            $model->save();
            foreach($model->get_list_M_Playerticker() as $playertikcer){
                $playertikcer->IsUpdated = 1;
                $playertikcer->save();
            }
        }
        
        echo "success";

    }

    public function deleteAllPlayer(){
        $tickerid = $this->input->post('tickerid');
        $params = array(
            'where' => array(
                'M_Ticker_Id' => $tickerid 
            )
        );

        $models = $this->M_tickerdetails->get_list(null, null, $params);

        foreach($models as $model){ 
            $model->IsDeleted = 1;
            $model->save();
            foreach($model->get_list_M_Playerticker() as $playertikcer){
                $playertikcer->IsUpdated = 1;
                $playertikcer->save();
            }
        }
        echo "success";
    }

}