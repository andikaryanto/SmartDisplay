<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DatabaseLoader {
    private $CI;
    function __construct()
    {

    }

    function Initialize() {
        $CI =& get_instance();
        $database = "database_2019";
        if(!empty($_SESSION['database']))
            $database = $_SESSION['database'];    
        
        $CI->load->database($database);

    }
}