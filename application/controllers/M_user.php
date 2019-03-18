<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->database('natureuser', TRUE);
        //$this->load->model(array('M_users','M_groupusers', 'G_languages', 'G_colors', 'M_usersettings'));
        $this->paging->is_session_set();
    }

    public function index()
    {
        // echo json_encode($_SESSION);
        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$form['m_user'],'Read'))
        {
            $params = array(
                'where' => array('Username !=' => 'superadmin'),
                'order' => array('Created' => 'ASC')
            );
            //echo json_encode($params['where_not_in']);

            $datapages = $this->M_users->get_list(null, null, $params);
            $data['model'] = $datapages;
            load_view('m_user/index', $data);
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
        if($this->M_groupusers->is_permitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$form['m_user'],'Write'))
        {
            
            $model = $this->M_users->new_object();
            $modal_group = $this->M_groupusers->get_list();
            $data_modal = array(
                'modal_group' => $modal_group
            );
            $data =  $this->paging->set_data_page_add($model, null, $data_modal);
            load_view('m_user/add', $data);   
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
        $username   = $this->input->post('named');
        $password   = $this->input->post('password');

        $model = $this->M_users->new_object();
        $model->M_Groupuser_Id = $groupid;
        $model->Username = $username;
        $model->setPassword($password);
        $model->IsLoggedIn = 0;
        $model->IsActive = 1;
        $model->Language = 'indonesia';
        $model->CreatedBy = $_SESSION[get_variable().'userdata']['Username'];
        //echo json_encode($model);
        $validate = $this->M_users->validate($model);
 
        if($validate)
        {
            $this->session->set_flashdata('add_warning_msg',$validate); 
            $modal_group = $this->M_groupusers->get_list();
            $data_modal = array(
                'modal_group' => $modal_group
            );
            $data =  $this->paging->set_data_page_add($model, null, $data_modal);
            load_view('m_user/add', $data);   
        }
        else{
            $new_data = $model->save_with_detail();
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('muser/add');
        }
    }

    public function edit($id)
    {
        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$form['m_user'],'Write'))
        {
            
            $model = $this->M_users->get($id);
            $data =  $this->paging->set_data_page_edit($model);
            //echo json_encode($edit);
            load_view('m_user/edit', $data);   
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

        $model = $this->M_users->get($userid);
        $oldmodel = clone $model;

        $model->M_Groupuser_Id = $groupid;
        $model->Username = $username;
        $model->ModifiedBy = $_SESSION[get_variable().'userdata']['Username'];

        $validate   = $this->M_users->validate($model, $oldmodel);
 
        if($validate)
        {
            $this->session->set_flashdata('edit_warning_msg',$validate);
            $data =  $this->paging->set_data_page_edit($model);
            load_view('m_user/edit', $data);   
        }
        else
        {
            $model->save();
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('muser');
        }
    }

    public function delete($id)
    {
        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$form['m_user'],'Delete'))
        {
            $delete = $this->M_users->delete_data($id);
            if(isset($delete)){
                $deletemsg = $this->helpers->get_query_error_message($delete['code']);
                $this->session->set_flashdata('warning_msg', $deletemsg);
            } else {
                $deletemsg = $this->paging->get_delete_message();
                $this->session->set_flashdata('delete_msg', $deletemsg);
            }
            redirect('muser');
        }
        else
        {   
            $this->load->view('forbidden/forbidden');
        }   
    }

    public function setting(){
        // $enums['languageenums'] =  $this->G_languages->get_list();
        // $enums['colorenums'] =  $this->G_colors->get_list();
        // $data = $this->paging->set_data_page_add(null, $enums);
        load_view('m_user/settings');
    }

    public function profile(){
        
        $user = $this->M_users->get($_SESSION[get_variable().'userdata']['Id']);
        $profile = $user->get_list_M_Userprofile()[0];
        $data['model'] = $profile;
        load_view('m_user/profile', $data);
    }

    public function activate($id)
    {
        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$form['m_user'],'Write'))
        {
            $muser = $this->M_users->get($id);
            if($muser){
                $muser->IsActive = $muser->IsActive ? 0 : 1;
                $muser->save();
            }
            redirect('muser');
        }
        else
        {   
            $this->load->view('forbidden/forbidden');
        }   
    }

    public function changePassword(){
        $model = array(
            'oldpassword' => "",
            'newpassword' => "",
            'confirmpassword' => ""
        );
        $data['model'] = $model;
        load_view('m_user/changePassword', $data);    
    }

    public function saveNewPassword(){
        
        $oldpassword = $this->input->post('oldpassword');
        $newpassword = $this->input->post('newpassword');
        $confirmpassword = $this->input->post('confirmpassword');
        $model = array(
            'oldpassword' => $oldpassword,
            'newpassword' => $newpassword,
            'confirmpassword' =>  $confirmpassword
        );
        
        
        $validate = $this->M_users->validate_changepassword($_SESSION[get_variable().'userdata']['Username'], $oldpassword, $newpassword, $confirmpassword);
        if($validate){
            $this->session->set_flashdata('warning_msg',$validate);
            $data =  $this->paging->set_data_page_add($model);
            load_view('m_user/changePassword', $data);    
        }
        else{
            $this->M_users->saveNewPassword($_SESSION[get_variable().'userdata']['Username'], $oldpassword, $newpassword);
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('changePassword');
        }
    }

    public function savesetting(){
        $language = $this->input->post('languageid');
        $radiocolor = $this->input->post('radiocolor');
        $rowperpage = $this->input->post('rowperpage');
        //$usersetting = $this->M_users->create_usersetting_object($_SESSION['usersettings']['Id'], $_SESSION[get_variable().'userdata']['id'],$language, explode("~",$radiocolor)[1],  $rowperpage);
        $usersetting = $this->M_usersettings->get($_SESSION['usersettings']['Id']);
        $usersetting->G_Language_Id = $language;
        $usersetting->G_Color_Id = explode("~",$radiocolor)[1];
        $usersetting->RowPerpage = $rowperpage;
        $usersetting->save();

        $languages = $this->G_languages->get($language);
        $colors = $this->G_colors->get(explode("~",$radiocolor)[1]);
        replaceSession('usersettings', get_object_vars($usersetting));
        replaceSession('languages', get_object_vars($languages));
        replaceSession('colors', get_object_vars($colors));
        redirect('settings');
    }

    public function saveprofile(){
        $user = $this->M_users->get($_SESSION[get_variable().'userdata']['Id']);
        $profile = $user->get_list_M_Userprofile()[0];


        $completename = $this->input->post('completename');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $email = $this->input->post('email');
        $aboutme = $this->input->post('aboutme');
        $newphotoname="";
        // echo json_encode($_FILES['file']['name']);

        if(!empty($_FILES['file']['name'])){
            $newphotoname = $this->upload_profile_pic($_FILES['file']);
            unlink($profile->PhotoPath.$profile->PhotoName);
        }

        $profile->CompleteName = $completename;
        $profile->Address = $address;
        $profile->Phone = $phone;
        $profile->Email = $email;
        $profile->AboutMe = $aboutme;
        if(!empty($_FILES['file']['name']))
            $profile->PhotoName = $newphotoname;
        $profile->save();
        // echo json_encode($_FILES);

        replaceSession('userprofile', get_object_vars($profile));
        redirect('profile');
    }

    private function upload_profile_pic($files){
        $config = userprofile_upload_config();
        $this->load->library('upload', $config);
        $date = date("YmdHis");

        //$newName = $date."_".str_replace(".","_",preg_replace('/\s+/', '', $files['name']));
        $newName = $date."_". $files['name'];
            
        $_FILES['file']['name']= $newName;
        $_FILES['file']['type']= $files['type'];
        $_FILES['file']['tmp_name']= $files['tmp_name'];
        $_FILES['file']['error']= $files['error'];
        $_FILES['file']['size']= $files['size'];

        $config['file_name'] = $newName;
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('file'))
        {
                $error = array('error' => $this->upload->display_errors());

        }
        else
        {
                // $this->upload->data();
                // $submissionfiles = $this->T_submissionfiles->new_object();
                // $submissionfiles->T_Submission_Id = $submissionid;
                // $submissionfiles->FileName = $newName;
                // $submissionfiles->FileType = $files['type'];
                // $submissionfiles->Path = $config['upload_path'];
                // $submissionfiles->CreatedBy = $_SESSION[get_variable().'userdata']['Username'];
                // $submissionfiles->save();
                
        }
        return $newName;
    }
    
}