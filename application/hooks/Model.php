<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelLoader {
    private $CI;
    function __construct()
    {
        $this->CI =& get_instance();
    }

    function Initialize() {
        $CI =& get_instance();
        $CI->load->model(array('G_colors', 'G_languages', 'G_transactionnumbers','M_accessroles',
                            'M_enums', 'M_forms', 'M_groupusers', 'M_users','M_usersettings', 'M_userprofiles',
                            'M_groupplayers', 'M_companies', 'M_formsettings', 'R_reports',
                            'R_reportaccessroles', 'M_players', 'M_playerslots', 'M_events'));
    }
}