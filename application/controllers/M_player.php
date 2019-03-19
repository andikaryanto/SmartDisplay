<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_player extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->database('natureuser', TRUE);
        //$this->load->model(array('M_players','M_players', 'G_languages', 'G_colors', 'M_playersettings'));
        $this->paging->is_session_set();
    }

    public function index()
    {
        // echo json_encode($_SESSION);
        $form = $this->paging->get_form_name_id();
        if(is_permitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$form['m_player'],'Read'))
        {

            $datapages = $this->M_players->get_list();
            $data['model'] = $datapages;
            load_view('m_player/index', $data);
        }
       else
        {   
            
            $this->load->view('forbidden/forbidden');
        }
    }

    public function add()
    {
        
        // redirect("M_groupuser/add?param=1");
        $form = $this->paging->get_form_name_id();
        if(is_permitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$form['m_player'],'Write'))
        {
            
            $model = $this->M_players->new_object();
            
            $validate = $this->M_players->validate($model, null, true);
            if($validate)
            {
                $this->session->set_flashdata('add_warning_msg',$validate); 
                redirect('mplayer');
            } else {
                $data = $this->paging->set_data_page_add($model);
                load_view('m_player/add', $data);   
            }
        }
        else
        {
            $this->load->view('forbidden/forbidden');
        }
    }

    public function addsave()
    {
        //$date = new DateTime();
        $warning    = array();
        $err_exist  = false;
       
        $groupid    = $this->input->post('groupid');
        $name   = $this->input->post('named');

        $model = $this->M_players->new_object();
        $model->M_Groupplayer_Id = $groupid;
        $model->Name = $name;
        $model->IsActive = 1;

        $validate = $this->M_players->validate($model);
 
        if($validate)
        {
            $this->session->set_flashdata('add_warning_msg',$validate); 
            $data =  $this->paging->set_data_page_add($model);
            load_view('m_player/add', $data);   
        }
        else{
            $model->save();
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            if($this->M_players->count() >= $this->M_playerslots->get(1)->Count)
                redirect('mplayer');
            else 
                redirect('mplayer/add');
        }
    }

    public function edit($id)
    {
        $form = $this->paging->get_form_name_id();
        if(is_permitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$form['m_player'],'Write'))
        {
            
            $model = $this->M_players->get($id);
            $data =  $this->paging->set_data_page_edit($model);
            //echo json_encode($edit);
            load_view('m_player/edit', $data);   
        }
        else{
            
            $this->load->view('forbidden/forbidden');
        }
    }

    public function editsave()
    {
       

        $userid     = $this->input->post('userid');
        $groupid    = $this->input->post('groupid');
        $groupname  = $this->input->post('groupname');
        $username   = $this->input->post('named');

        $model = $this->M_players->get($userid);
        $oldmodel = clone $model;

        $model->M_Groupuser_Id = $groupid;
        $model->Username = $username;
        $model->ModifiedBy = $_SESSION[get_variable().'userdata']['Username'];

        $validate   = $this->M_players->validate($model, $oldmodel);
 
        if($validate)
        {
            $this->session->set_flashdata('edit_warning_msg',$validate);
            $data =  $this->paging->set_data_page_edit($model);
            load_view('m_player/edit', $data);   
        }
        else
        {
            $model->save();
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('mplayer');
        }
    }

    public function activate($id)
    {
        $form = $this->paging->get_form_name_id();
        if(is_permitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$form['m_player'],'Write'))
        {
            $mplayer = $this->M_players->get($id);
            if($mplayer){
                $mplayer->IsActive = $mplayer->IsActive ? 0 : 1;
                $mplayer->save();
            }
            redirect('mplayer');
        }
        else
        {   
            $this->load->view('forbidden/forbidden');
        }   
    }
    
}