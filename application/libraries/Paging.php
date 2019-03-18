<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paging {

    public function get_config()
    {
        $data["perpage"] = 5;
        $data["perpagemodal"] = 5;
        $data["pagelen"] = 5;
        return $data;
    }

    public function get_form_name_id()
    {
        $data["m_groupuser"] = "m_groupusers";
        $data["m_user"] = "m_users";
        $data["m_chartofaccount"] = "m_chartofaccounts";
        $data["m_company"] = "m_companies";
        $data["m_form"] = "m_forms";
        $data["r_report"] = "r_reports";
        $data["t_journal"] = "t_journals";
        $data["m_beginningbalance"] = "m_beginningbalances";
        return $data;
    }

    public function get_report_name_id()
    {
        $data["journal"] = "Journal";
        $data["generalledger"] = "GeneralLedger";
        $data["trialbalance"] = "TrialBalance";
        $data["profitloss"] = "ProfitLoss";
        return $data;
    }
    
    public function get_enum_name()
    {
        $data["months"] = 1;
        $data["gender"] = 2;
        $data["religion"] = 3;
        $data["WorkStatus"] = 4;
        return $data;
    }

    public function load_header()
    {

        $CI =& get_instance();
        //$CI->load->model(array("M_forms")); $CI =& get_instance();
        $data['period'] = "";
        $companyname = lang('ui_instancename');
        $company = $CI->M_companies->get_list();
        if($company){
            $companyname = $company[0]->CompanyName;
            $data['period'] = $company[0]->Period;
        }
        $setupmenu = $CI->M_forms->get_data_by_classname("Setup");
        $mastermenu = $CI->M_forms->get_data_by_classname("Master");
        $generalmenu = $CI->M_forms->get_data_by_classname("General");
        $transactionmenu = $CI->M_forms->get_data_by_classname("Transaction");

        $data['companyname'] = $companyname;
        $data['setupmenu'] = $setupmenu;
        $data['mastermenu'] = $mastermenu;
        $data['generalmenu'] = $generalmenu;
        $data['transactionmenu'] = $transactionmenu;

        //print_r($data['mastermenu']);
        // foreach($mastermenu as $menu){
        //     echo $menu->Resource." ";
        // }
        //print_r($_SESSION['usersettings']);
        $CI->load->view('template/header', $data); 
    }

    public function load_report_header()
    {

        $CI =& get_instance();
        $CI->load->view('template/reportheader'); 
    }

    public function load_footer()
    {
        $CI =& get_instance();
        $CI->load->view('template/footer');
    }

    private function set_resources_header_page()
    {
        
        $resource['flag'] = base_url('assets/bootstrapdashboard/img/flags/16/US.png');
        if($_SESSION['languages']['Name'] === 'indonesia'){
            $resource['flag'] = base_url('assets/bootstrapdashboard/img/flags/16/ID.png');;
        }

        return $resource;
    }

    public function is_session_set()
    {
        $CI =& get_instance();
        //$sitestatus = $CI->Gsitestatus_model->get_alldata();
        //if(isset($sitestatus) && $sitestatus->Status == 2){
            //echo json_encode($sitestatus);
            if(isset($_SESSION[get_variable().'userdata']))
            {
                //redirect('home');
            }
            else
            {
                redirect('login');
            }
        // }
        // else{
        //     //echo json_encode($sitestatus);
        //     //echo json_encode("aaa");
        //     //$data['resource'] = $CI->paging->set_resources_forbidden_page();
        //     if(isset($_SESSION[get_variable().'userdata']) && $_SESSION[get_variable().'userdata']['username'] !== "superadmin")
        //         redirect('maintenance');
        // }
        
    }

    public function set_data_page_add($model = null, $enums = null, $data_modal = array())
    {
        $data['model'] = $model;
        $data['enums'] = $enums;
        $data['datamodal'] = $data_modal;
        return $data;
    }

    public function set_data_page_edit($model = null, $enums = null, $data_modal = array())
    {
        $data['model'] = $model;
        $data['enums'] = $enums;
        $data['datamodal'] = $data_modal;
        return $data;
    }

    public function is_superadmin($user)
    {
        $permited = false;
        if($user == "superadmin")
        {
            $permited = true;
        }
        return $permited;
    }

    public function set_data_page_index($modeldetail, $totalrow = null, $currentpage = 0, $search = null, $modelheader = null, $pagesize = null)
    {
        $config = $this->get_config();
        $pagesz = $_SESSION['usersettings']['RowPerpage']; //5 or whatever
        if(!empty($pagesize))
        {
            $pagesz = $pagesize;
        }
        $totalpage = 0;
        $firstpage = 1;
        $lastpage = 3;
        if($totalrow)
        {
            $totalpage = ceil($totalrow / $pagesz);
            if($totalpage > $config["pagelen"])
            {
                $lastpage = $currentpage + 2;
                if($lastpage > $totalpage)
                {
                    $lastpage = $totalpage;
                    if($lastpage - $config['pagelen'] < 0)
                    {
                        $firstpage = 1;
                    }
                    else
                    {
                        $firstpage = $totalpage - $config['pagelen'] + 1;;
                    }
                }
                else{
                    if($lastpage < $config['pagelen'])
                    {
                        $firstpage = 1;
                        $lastpage = $config['pagelen'];
                    }
                    else{
                        if($currentpage >= $totalpage - 2)
                        {
                            $firstpage = $totalpage - $config['pagelen'] + 1;
                            $lastpage = $totalpage;
                        }
                        else
                        {
                            $firstpage = $lastpage - $config['pagelen'] + 1;
                        }
                    }
                }
            }
            else{
                $lastpage = $totalpage;
            }
        } else {
            
            $firstpage = 0;
            $lastpage = 0;
        }

        $startNumber = 1;
        if($currentpage > 1){
            $startNumber = (($currentpage - 1)*$pagesz) + 1;
        }

        $data['modelheader'] = $modelheader;
        $data['modeldetail'] = $modeldetail;
        $data['totalrow'] = $totalrow;
        $data['totalpage'] = $totalpage;
        $data['currentpage'] = (int)$currentpage;
        $data['startnumber'] = $startNumber;
        $data['firstpage'] = $firstpage;
        $data['lastpage'] = $lastpage;
        $data['search'] = $search;
        $data['firstrow'] = $startNumber;
        $data['lastrow'] = count($modeldetail) < $pagesz ? $totalrow : $startNumber + $pagesz - 1;
        return $data;
    }

    public function get_success_message(){

        $msg = array();

        $msg = array_merge($msg, array(0=>'ui_datasaved'));
        return $msg;
    }

    public function get_delete_message(){
        $msg = array();

        $msg = array_merge($msg, array(0=>lang('ui_datadeleted')));
        return $msg;
    }

    public function set_data_page_modal($modeldetail, $totalrow = null, $currentpage = 0, $search = null, $modelheader = null, $tabelname = null, $pagesize = null)
    {
        $config = $this->get_config();
        $totalpage = 0;
        $firstpage = 1;
        $lastpage = 3;
        $pagesz = $config['perpagemodal'];
        if(!empty($pagesize))
        {
            $pagesz = $pagesize;
        }

        if($totalrow)
        {
            $totalpage = ceil($totalrow / $config['perpagemodal']);
            if($totalpage > $config["pagelen"])
            {
                //$firstpage = $page - 2;
                $lastpage = $currentpage + 2;
                if($lastpage > $totalpage)
                {
                    $lastpage = $totalpage;
                    if($lastpage - $config['pagelen'] < 0)
                    {
                        $firstpage = 1;
                    }
                    else
                    {
                        $firstpage = $totalpage - $config['pagelen'] + 1;;
                    }
                }
                else{
                    //$lastpage = $config['pagelen'];
                    if($lastpage < $config['pagelen'])
                    {
                        $firstpage = 1;
                        $lastpage = $config['pagelen'];
                    }
                    else{
                        if($currentpage >= $totalpage - 2)
                        {
                            $firstpage = $totalpage - $config['pagelen'] + 1;
                            $lastpage = $totalpage;
                        }
                        else
                        {
                            $firstpage = $lastpage - $config['pagelen'] + 1;
                        }
                    }
                }
            }
            else{
                $lastpage = $totalpage;
            }
        } else {
            
            $firstpage = 0;
            $lastpage = 0;
        }

        $startNumber = 1;
        if($currentpage > 1){
            $startNumber = (($currentpage - 1)*$pagesz) + 1;
        }

        $data[$tabelname]['modelheadermodal'] = $modelheader;
        $data[$tabelname]['modeldetailmodal'] = $modeldetail;
        $data[$tabelname]['totalrowmodal'] = $totalrow;
        $data[$tabelname]['totalpagemodal'] = $totalpage;
        $data[$tabelname]['currentpagemodal'] = (int)$currentpage;
        $data[$tabelname]['firstpagemodal'] = $firstpage;
        $data[$tabelname]['lastpagemodal'] = $lastpage;
        $data[$tabelname]['searchmodal'] = $search;
        $data[$tabelname]['firstrowmodal'] = $startNumber;
        $data[$tabelname]['lastrowmodal'] = $totalrow < $pagesz ? $totalrow : $startNumber + $pagesz - 1;
        return $data;
    }

}