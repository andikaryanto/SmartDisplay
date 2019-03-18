<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LanguageLoader {
    private $CI;
    function __construct()
    {
        
        //parent::__construct();
        $this->CI =& get_instance();

        if(!isset($this->CI->session)){  //Check if session lib is loaded or not
              $this->CI->load->library('session');  //If not loaded, then load it here
        }
    }

    function Initialize() {
        $CI =& get_instance();
        //$usersetting = $this->CI->session->userdata('usersettings');
        $CI->load->helper(array('language'));
        $CI->lang->load(array('form_ui','err_msg','info_msg', 'reports_name'), !empty($_SESSION[get_variable().'languages']['Name']) ? $_SESSION[get_variable().'languages']['Name'] : $this->CI->config->item('language'));
    }
}