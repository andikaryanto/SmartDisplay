<?php
class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->model('M_users');

    }

    public function index()
    {
        if(isset($_SESSION[get_variable().'userdata'])){
            redirect('home');
        }
        else{
            $this->load->view('login/login');
        }
    }
    public function dologin()
    {
        $username = $this->input->post('loginUsername');
        $password = $this->input->post('loginPassword');    
        
        $params = array(
            'where' => array(
                'Password' => encryptMd5(get_variable().$username.$password)
            )
        );
        $query = $this->M_users->get(null, null, $params);
        // echo json_encode($query);
        // echo json_encode(encryptMd5(get_variable().$username.$password));
        // echo ENVIRONMENT;
        // echo $this->db->database;  
        if ($query)  
        {    
            if($query->IsActive == 1){
                //print_r($query->get_list_M_User());  
                $this->session->set_userdata(get_variable().'userdata',get_object_vars($query));
                $this->session->set_userdata(get_variable().'usersettings',get_object_vars($query->get_list_M_Usersetting()[0]));
                $this->session->set_userdata(get_variable().'userprofile',get_object_vars($query->get_list_M_Userprofile()[0]));
                $this->session->set_userdata(get_variable().'languages',get_object_vars($query->get_list_M_Usersetting()[0]->get_G_Language()));
                // $this->session->set_userdata(get_variable().'colors',get_object_vars($query->get_list_M_Usersetting()[0]->get_G_Color()));echo json_encode($query);
                redirect('home');
            } else {
                redirect('login');
            }
        }
        else{
            redirect('login');
        }
    }

    public function dologout()
    {
        //$username = $_SESSION['userdata']['Username'];
        unset(
            $_SESSION[get_variable().'userdata'],
            $_SESSION[get_variable().'usersettings'],
            $_SESSION[get_variable().'userprofile'],
            $_SESSION[get_variable().'languages'],
            $_SESSION[get_variable().'colors'],
            $_SESSION[get_variable().'database']
        );
        redirect('login');
    }

    private function loadview($viewName)
	{
		$this->load->view('template/header');
		$this->load->view($viewName);
		$this->load->view('template/footer');
    }
    
}