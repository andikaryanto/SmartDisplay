<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//require_once APPPATH . "third_party/PHPExcel.php";

class Reports extends CI_Controller{
    
    public function __construct()
    {
        parent::__construct();
        //$this->load->model(array('M_villages','M_subcities','M_groupusers')); 
        $this->paging->is_session_set();
        //$this->load->model('Export', 'export');
    }

    public function index(){
        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$form['r_report'],'Read'))
        {
            $company = $this->M_companies->get_list();
            if($company){
                $datapages = $this->R_reports->get_list();
                $data['model'] = $datapages;
                load_view('report/index', $data);
            } else {
                
                $this->session->set_flashdata('edit_warning_msg',array(0=> "err_msg_please_set_company"));
                redirect('mcompany');
            }
        }
       else
        {   
            $this->load->view('forbidden/forbidden');
        }
    }

    public function submission_payment_view(){
        $form = $this->paging->get_report_name_id();
        if($this->M_groupusers->is_reportpermitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$form['submissionpayment'],'Read'))
        {
            load_view('report/submission_payment');
        } else {   
            $this->load->view('forbidden/forbidden');
        }
    }

    public function journal_view(){
        $form = $this->paging->get_report_name_id();
        if($this->M_groupusers->is_reportpermitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$form['journal'],'Read'))
        {
            load_view('report/journal');
        } else {   
            $this->load->view('forbidden/forbidden');
        }
    }

    public function generalledger_view(){
        $form = $this->paging->get_report_name_id();
        if($this->M_groupusers->is_reportpermitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$form['generalledger'],'Read'))
        {
            load_view('report/generalledger');
        } else {   
            $this->load->view('forbidden/forbidden');
        }
    }

    public function trialbalance_view(){
        $form = $this->paging->get_report_name_id();
        if($this->M_groupusers->is_reportpermitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$form['trialbalance'],'Read'))
        {
            load_view('report/trialbalance');
        } else {   
            $this->load->view('forbidden/forbidden');
        }
    }

    

    public function profitloss_view(){
        $form = $this->paging->get_report_name_id();
        if($this->M_groupusers->is_reportpermitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$form['profitloss'],'Read'))
        {
            load_view('report/profitloss');
        } else {   
            $this->load->view('forbidden/forbidden');
        }
    }

    
    //end view region
    public function journal_pdf(){
        $rangetype = $this->input->post('rangetype');
        $rangeselect = $this->input->post('range');
        $datefrom = $this->input->post('datefrom');
        $dateto = $this->input->post('dateto');
        $preview = $this->input->post('preview');
        $ispreview = false;
        
        if(isset($preview))
            $ispreview = true;
        
        if($rangetype == 1){
            $dateObj = new DateTime($datefrom);
            $datefrom = $dateObj->format('Y-m-d');

            
            $dateObj = new DateTime($dateto);
            $dateto = $dateObj->format('Y-m-d');
            // echo $datefrom;
            $this->journal_filtered_pdf($datefrom, $dateto, $ispreview);
        }
        else if($rangetype == 2){
            $dateObj = new DateTime();
            $dateObj->setDate(date('Y'), $rangeselect, 1);
            $date = $dateObj->format('Y-m-d');
            $fromdate = $date;
            $todate = date_format($dateObj, 'Y-m-t');
            // echo $todate;
            $this->journal_filtered_pdf($fromdate, $todate, $ispreview);
        } else if ($rangetype == 3){
            if($rangeselect == 1){
                
                $newdatefrom = new DateTime();
                $newdatefrom->setDate(date('Y'), 1, 1);
                $datefromformat = $newdatefrom->format('Y-m-d');

                $newdateto = new DateTime();
                $newdateto->setDate(date('Y'), 3, 1);
                $datetoformat = $newdateto->format('Y-m-t');

                $this->journal_filtered_pdf($datefromformat, $datetoformat, $ispreview);

            } else if($rangeselect == 2){
                
                $newdatefrom = new DateTime();
                $newdatefrom->setDate(date('Y'), 4, 1);
                $datefromformat = $newdatefrom->format('Y-m-d');

                $newdateto = new DateTime();
                $newdateto->setDate(date('Y'), 6, 1);
                $datetoformat = $newdateto->format('Y-m-t');

                $this->journal_filtered_pdf($datefromformat, $datetoformat, $ispreview);


            } else if($rangeselect == 3){
                
                $newdatefrom = new DateTime();
                $newdatefrom->setDate(date('Y'), 7, 1);
                $datefromformat = $newdatefrom->format('Y-m-d');

                $newdateto = new DateTime();
                $newdateto->setDate(date('Y'), 9, 1);
                $datetoformat = $newdateto->format('Y-m-t');

                $this->journal_filtered_pdf($datefromformat, $datetoformat, $ispreview);


            } else {
                $newdatefrom = new DateTime();
                $newdatefrom->setDate(date('Y'), 10, 1);
                $datefromformat = $newdatefrom->format('Y-m-d');

                $newdateto = new DateTime();
                $newdateto->setDate(date('Y'), 12, 1);
                $datetoformat = $newdateto->format('Y-m-t');

                $this->journal_filtered_pdf($datefromformat, $datetoformat, $ispreview);
            } 
        } else if ($rangetype == 4) {
            if($rangeselect == 1){
                $newdatefrom = new DateTime();
                $newdatefrom->setDate(date('Y'), 1, 1);
                $datefromformat = $newdatefrom->format('Y-m-d');

                $newdateto = new DateTime();
                $newdateto->setDate(date('Y'), 6, 1);
                $datetoformat = $newdateto->format('Y-m-t');

                $this->journal_filtered_pdf($datefromformat, $datetoformat, $ispreview);
            } else {
                $newdatefrom = new DateTime();
                $newdatefrom->setDate(date('Y'), 7, 1);
                $datefromformat = $newdatefrom->format('Y-m-d');

                $newdateto = new DateTime();
                $newdateto->setDate(date('Y'), 12, 1);
                $datetoformat = $newdateto->format('Y-m-t');

                $this->journal_filtered_pdf($datefromformat, $datetoformat, $ispreview);
            }
        } else {
            $newdatefrom = new DateTime();
            $newdatefrom->setDate(date('Y'), 1, 1);
            $datefromformat = $newdatefrom->format('Y-m-d');

            $newdateto = new DateTime();
            $newdateto->setDate(date('Y'), 12, 1);
            $datetoformat = $newdateto->format('Y-m-t');

            $this->journal_filtered_pdf($datefromformat, $datetoformat, $ispreview);
        }
        
    }

    public function journal_from_preview(){
        
        $datefrom = $this->input->post('datefrom');
        $dateto = $this->input->post('dateto');
        $this->journal_filtered_pdf($datefrom, $dateto, false);
    }

    public function trialbalance_pdf(){
        $rangetype = $this->input->post('rangetype');
        $rangeselect = $this->input->post('range');
        $datefrom = $this->input->post('datefrom');
        $dateto = $this->input->post('dateto');
        $preview = $this->input->post('preview');
        $ispreview = false;
        
        if(isset($preview))
            $ispreview = true;
        
        if($rangetype == 1){
            $dateObj = new DateTime($datefrom);
            $datefrom = $dateObj->format('Y-m-d');

            
            $dateObj = new DateTime($dateto);
            $dateto = $dateObj->format('Y-m-d');
            $this->trialbalance_filtered_pdf($datefrom, $dateto, $ispreview);

        }else if($rangetype == 2){
            $dateObj = new DateTime();
            $dateObj->setDate(date('Y'), $rangeselect, 1);
            $date = $dateObj->format('Y-m-d');
            $fromdate = $date;
            $todate = date_format($dateObj, 'Y-m-t');
            // echo $todate;
            $this->trialbalance_filtered_pdf($fromdate, $todate, $ispreview);
        } else if ($rangetype == 3){
            if($rangeselect == 1){
                
                $newdatefrom = new DateTime();
                $newdatefrom->setDate(date('Y'), 1, 1);
                $datefromformat = $newdatefrom->format('Y-m-d');

                $newdateto = new DateTime();
                $newdateto->setDate(date('Y'), 3, 1);
                $datetoformat = $newdateto->format('Y-m-t');

                $this->trialbalance_filtered_pdf($datefromformat, $datetoformat, $ispreview);

            } else if($rangeselect == 2){
                
                $newdatefrom = new DateTime();
                $newdatefrom->setDate(date('Y'), 4, 1);
                $datefromformat = $newdatefrom->format('Y-m-d');

                $newdateto = new DateTime();
                $newdateto->setDate(date('Y'), 6, 1);
                $datetoformat = $newdateto->format('Y-m-t');

                $this->trialbalance_filtered_pdf($datefromformat, $datetoformat, $ispreview);


            } else if($rangeselect == 3){
                
                $newdatefrom = new DateTime();
                $newdatefrom->setDate(date('Y'), 7, 1);
                $datefromformat = $newdatefrom->format('Y-m-d');

                $newdateto = new DateTime();
                $newdateto->setDate(date('Y'), 9, 1);
                $datetoformat = $newdateto->format('Y-m-t');

                $this->trialbalance_filtered_pdf($datefromformat, $datetoformat, $ispreview);


            } else {
                $newdatefrom = new DateTime();
                $newdatefrom->setDate(date('Y'), 10, 1);
                $datefromformat = $newdatefrom->format('Y-m-d');

                $newdateto = new DateTime();
                $newdateto->setDate(date('Y'), 12, 1);
                $datetoformat = $newdateto->format('Y-m-t');

                $this->trialbalance_filtered_pdf($datefromformat, $datetoformat, $ispreview);
            } 
        } else if ($rangetype == 4) {
            if($rangeselect == 1){
                $newdatefrom = new DateTime();
                $newdatefrom->setDate(date('Y'), 1, 1);
                $datefromformat = $newdatefrom->format('Y-m-d');

                $newdateto = new DateTime();
                $newdateto->setDate(date('Y'), 6, 1);
                $datetoformat = $newdateto->format('Y-m-t');

                $this->trialbalance_filtered_pdf($datefromformat, $datetoformat, $ispreview);
            } else {
                $newdatefrom = new DateTime();
                $newdatefrom->setDate(date('Y'), 7, 1);
                $datefromformat = $newdatefrom->format('Y-m-d');

                $newdateto = new DateTime();
                $newdateto->setDate(date('Y'), 12, 1);
                $datetoformat = $newdateto->format('Y-m-t');

                $this->trialbalance_filtered_pdf($datefromformat, $datetoformat, $ispreview);
            }
        } else {
            $newdatefrom = new DateTime();
            $newdatefrom->setDate(date('Y'), 1, 1);
            $datefromformat = $newdatefrom->format('Y-m-d');

            $newdateto = new DateTime();
            $newdateto->setDate(date('Y'), 12, 1);
            $datetoformat = $newdateto->format('Y-m-t');

            $this->trialbalance_filtered_pdf($datefromformat, $datetoformat, $ispreview);
        }
        
    }

    public function trialbalance_from_preview(){
        
        $datefrom = $this->input->post('datefrom');
        $dateto = $this->input->post('dateto');
        $this->trialbalance_filtered_pdf($datefrom, $dateto, false);
    }

    public function profitloss_pdf(){
        $rangetype = $this->input->post('rangetype');
        $rangeselect = $this->input->post('range');
        $datefrom = $this->input->post('datefrom');
        $dateto = $this->input->post('dateto');
        $preview = $this->input->post('preview');
        $ispreview = false;
        
        if(isset($preview))
            $ispreview = true;
        
        if($rangetype == 1){
            $dateObj = new DateTime($datefrom);
            $datefrom = $dateObj->format('Y-m-d');

            
            $dateObj = new DateTime($dateto);
            $dateto = $dateObj->format('Y-m-d');
            $this->profitloss_filtered_pdf($datefrom, $dateto, $ispreview);

        }else if($rangetype == 2){
            $dateObj = new DateTime();
            $dateObj->setDate(date('Y'), $rangeselect, 1);
            $date = $dateObj->format('Y-m-d');
            $fromdate = $date;
            $todate = date_format($dateObj, 'Y-m-t');
            // echo $todate;
            $this->profitloss_filtered_pdf($fromdate, $todate, $ispreview);
        } else if ($rangetype == 3){
            if($rangeselect == 1){
                
                $newdatefrom = new DateTime();
                $newdatefrom->setDate(date('Y'), 1, 1);
                $datefromformat = $newdatefrom->format('Y-m-d');

                $newdateto = new DateTime();
                $newdateto->setDate(date('Y'), 3, 1);
                $datetoformat = $newdateto->format('Y-m-t');

                $this->profitloss_filtered_pdf($datefromformat, $datetoformat, $ispreview);

            } else if($rangeselect == 2){
                
                $newdatefrom = new DateTime();
                $newdatefrom->setDate(date('Y'), 4, 1);
                $datefromformat = $newdatefrom->format('Y-m-d');

                $newdateto = new DateTime();
                $newdateto->setDate(date('Y'), 6, 1);
                $datetoformat = $newdateto->format('Y-m-t');

                $this->profitloss_filtered_pdf($datefromformat, $datetoformat, $ispreview);


            } else if($rangeselect == 3){
                
                $newdatefrom = new DateTime();
                $newdatefrom->setDate(date('Y'), 7, 1);
                $datefromformat = $newdatefrom->format('Y-m-d');

                $newdateto = new DateTime();
                $newdateto->setDate(date('Y'), 9, 1);
                $datetoformat = $newdateto->format('Y-m-t');

                $this->profitloss_filtered_pdf($datefromformat, $datetoformat, $ispreview);


            } else {
                $newdatefrom = new DateTime();
                $newdatefrom->setDate(date('Y'), 10, 1);
                $datefromformat = $newdatefrom->format('Y-m-d');

                $newdateto = new DateTime();
                $newdateto->setDate(date('Y'), 12, 1);
                $datetoformat = $newdateto->format('Y-m-t');

                $this->profitloss_filtered_pdf($datefromformat, $datetoformat, $ispreview);
            } 
        } else if ($rangetype == 4) {
            if($rangeselect == 1){
                $newdatefrom = new DateTime();
                $newdatefrom->setDate(date('Y'), 1, 1);
                $datefromformat = $newdatefrom->format('Y-m-d');

                $newdateto = new DateTime();
                $newdateto->setDate(date('Y'), 6, 1);
                $datetoformat = $newdateto->format('Y-m-t');

                $this->profitloss_filtered_pdf($datefromformat, $datetoformat, $ispreview);
            } else {
                $newdatefrom = new DateTime();
                $newdatefrom->setDate(date('Y'), 7, 1);
                $datefromformat = $newdatefrom->format('Y-m-d');

                $newdateto = new DateTime();
                $newdateto->setDate(date('Y'), 12, 1);
                $datetoformat = $newdateto->format('Y-m-t');

                $this->profitloss_filtered_pdf($datefromformat, $datetoformat, $ispreview);
            }
        } else {
            $newdatefrom = new DateTime();
            $newdatefrom->setDate(date('Y'), 1, 1);
            $datefromformat = $newdatefrom->format('Y-m-d');

            $newdateto = new DateTime();
            $newdateto->setDate(date('Y'), 12, 1);
            $datetoformat = $newdateto->format('Y-m-t');

            $this->profitloss_filtered_pdf($datefromformat, $datetoformat, $ispreview);
        }
        
    }

    public function profitloss_from_preview(){
        
        $datefrom = $this->input->post('datefrom');
        $dateto = $this->input->post('dateto');
        $this->profitloss_filtered_pdf($datefrom, $dateto, false);
    }

    public function generalledger_pdf(){
        $coaid = $this->input->post('chartofaccountid');
        $rangetype = $this->input->post('rangetype');
        $rangeselect = $this->input->post('range');
        $datefrom = $this->input->post('datefrom');
        $dateto = $this->input->post('dateto');
        $preview = $this->input->post('preview');
        $ispreview = false;
        if(isset($preview))
            $ispreview = true;

        if(empty($coaid)){
            $this->session->set_flashdata('edit_warning_msg', array(0=>'err_msg_acount_code_can_not_null'));
            load_view('report/generalledger');
        } else {

            if($rangetype == 1) 
            {
                $dateObj = new DateTime($datefrom);
                $datefrom = $dateObj->format('Y-m-d');

                
                $dateObj = new DateTime($dateto);
                $dateto = $dateObj->format('Y-m-d');
                // echo $datefrom;
                $this->generalledger_filtered_pdf($coaid,$datefrom, $dateto, $ispreview);
            }
            else if($rangetype == 2){
                $dateObj = new DateTime();
                $dateObj->setDate(date('Y'), $rangeselect, 1);
                $date = $dateObj->format('Y-m-d');
                $fromdate = $date;
                $todate = date_format($dateObj, 'Y-m-t');
                $this->generalledger_filtered_pdf($coaid,$fromdate, $todate, $ispreview);
            } else if ($rangetype == 3){
                if($rangeselect == 1){
                    
                    $newdatefrom = new DateTime();
                    $newdatefrom->setDate(date('Y'), 1, 1);
                    $datefromformat = $newdatefrom->format('Y-m-d');

                    $newdateto = new DateTime();
                    $newdateto->setDate(date('Y'), 3, 1);
                    $datetoformat = $newdateto->format('Y-m-t');

                    $this->generalledger_filtered_pdf($coaid,$datefromformat, $datetoformat, $ispreview);

                } else if($rangeselect == 2){
                    
                    $newdatefrom = new DateTime();
                    $newdatefrom->setDate(date('Y'), 4, 1);
                    $datefromformat = $newdatefrom->format('Y-m-d');

                    $newdateto = new DateTime();
                    $newdateto->setDate(date('Y'), 6, 1);
                    $datetoformat = $newdateto->format('Y-m-t');

                    $this->generalledger_filtered_pdf($coaid,$datefromformat, $datetoformat, $ispreview);


                } else if($rangeselect == 3){
                    
                    $newdatefrom = new DateTime();
                    $newdatefrom->setDate(date('Y'), 7, 1);
                    $datefromformat = $newdatefrom->format('Y-m-d');

                    $newdateto = new DateTime();
                    $newdateto->setDate(date('Y'), 9, 1);
                    $datetoformat = $newdateto->format('Y-m-t');

                    $this->generalledger_filtered_pdf($coaid,$datefromformat, $datetoformat, $ispreview);


                } else {
                    $newdatefrom = new DateTime();
                    $newdatefrom->setDate(date('Y'), 10, 1);
                    $datefromformat = $newdatefrom->format('Y-m-d');

                    $newdateto = new DateTime();
                    $newdateto->setDate(date('Y'), 12, 1);
                    $datetoformat = $newdateto->format('Y-m-t');

                    $this->generalledger_filtered_pdf($coaid,$datefromformat, $datetoformat, $ispreview);
                } 
            } else if ($rangetype == 4) {
                if($rangeselect == 1){
                    $newdatefrom = new DateTime();
                    $newdatefrom->setDate(date('Y'), 1, 1);
                    $datefromformat = $newdatefrom->format('Y-m-d');

                    $newdateto = new DateTime();
                    $newdateto->setDate(date('Y'), 6, 1);
                    $datetoformat = $newdateto->format('Y-m-t');

                    $this->generalledger_filtered_pdf($coaid,$datefromformat, $datetoformat, $ispreview);
                } else {
                    $newdatefrom = new DateTime();
                    $newdatefrom->setDate(date('Y'), 7, 1);
                    $datefromformat = $newdatefrom->format('Y-m-d');

                    $newdateto = new DateTime();
                    $newdateto->setDate(date('Y'), 12, 1);
                    $datetoformat = $newdateto->format('Y-m-t');

                    $this->generalledger_filtered_pdf($coaid,$datefromformat, $datetoformat, $ispreview);
                }
            } else {
                $newdatefrom = new DateTime();
                    $newdatefrom->setDate(date('Y'), 1, 1);
                    $datefromformat = $newdatefrom->format('Y-m-d');

                    $newdateto = new DateTime();
                    $newdateto->setDate(date('Y'), 12, 1);
                    $datetoformat = $newdateto->format('Y-m-t');

                    $this->generalledger_filtered_pdf($coaid,$datefromformat, $datetoformat, $ispreview);
            }
        }
        
    }

    public function generalledger_from_preview(){
        
        $coaid = $this->input->post('coaid');
        $datefrom = $this->input->post('datefrom');
        $dateto = $this->input->post('dateto');
        $this->generalledger_filtered_pdf($coaid, $datefrom, $dateto, false);
    }
    
    public function journal_filtered_pdf($datefrom, $dateto, $ispreview){
        
        $CI =& get_instance();
        $mpdf = new \Mpdf\Mpdf([
            'default_font_size' => 11,
            'default_font' => 'helvetica'
        ]);

        $param = array(
            'where' => array(
                'TranDate >=' => date(get_formated_date($datefrom, 'Y-m-d')." 00:00:00"),
                'TranDate <=' => date(get_formated_date($dateto, 'Y-m-d')." 23:59:59")
            ),
            'order' => array(
                'TranDate' => 'ASC'
            )
        );

        $params = array(
            'datefrom' => $datefrom,
            'dateto' => $dateto
        );

        $company = $this->M_companies->get_list()[0];


        $model = array();
        $modelbody = array();

        $journal = $this->T_journals->get_list(null, null, $param);
        
        $totaldebet=0.00;
        $totalcredit=0.00;
        $trandate ="";
        $newtrandate = "";
        $debetmonth = 0.00;
        $creditmonth = 0.00;
        $decription = "";
        $i = 0;

        if($datefrom == "2019-01-01"){
            if($this->M_beginningbalances->isExistBeginningBalance()){
                $begbalance = $this->T_journals->getBeginningBalance();
                foreach($this->T_journaldetails->getBeginningBalance() as $balancedetail){
                    $trandate = get_formated_date($begbalance->TranDate, 'F');
                    $decription = $begbalance->JournalNo;
                    if($newtrandate != $trandate) { 
                        $newtrandate = $trandate;
                        // $modelbody[$newtrandate][$begbalance->JournalNo] = get_object_vars($begbalance);
                        $modelbody[$newtrandate][$begbalance->JournalNo][$i] = 
                            $this->createJournalBody(
                                $begbalance->TranDate,
                                $balancedetail->get_M_Chartofaccount()->Code."~".$balancedetail->get_M_Chartofaccount()->Name,
                                $balancedetail->Debet, 
                                $balancedetail->Credit
                            );
                        
                        $debetmonth += $balancedetail->Debet;
                        $creditmonth += $balancedetail->Credit;
                        $totaldebet += $balancedetail->Debet;
                        $totalcredit += $balancedetail->Credit;
                    } else {
                        $detail = 
                        $this->createJournalBody(
                            $begbalance->TranDate,
                            $balancedetail->get_M_Chartofaccount()->Code."~".$balancedetail->get_M_Chartofaccount()->Name,
                            $balancedetail->Debet, 
                            $balancedetail->Credit
                        );
                        $modelbody[$newtrandate][$begbalance->JournalNo][$i] = $detail;
                    }

                    $i++;
                }
            }
        }

        $i=0;
        foreach($journal as $model) {
            $noref = "";
            if($model->Refno)
                $noref  = " (Ref : ".$model->Refno.")";
            $trandate = get_formated_date($model->TranDate, 'F');
            if($newtrandate != $trandate) { 
                $newtrandate = $trandate;
                foreach($model->get_list_T_Journaldetail() as $journaldetail){
                    // $modelbody[$newtrandate][$model->JournalNo." ~ ".$model->Description.$noref] = get_object_vars($model);
                    $modelbody[$newtrandate][$model->JournalNo." ~ ".$model->Description.$noref][$i] = 
                    $this->createJournalBody(
                        $model->TranDate,
                        $journaldetail->get_M_Chartofaccount()->Code."~".$journaldetail->get_M_Chartofaccount()->Name,
                        $journaldetail->Debet, 
                        $journaldetail->Credit
                    );
                    $i++;
                }
                $i = 0;
                $decription = $model->JournalNo;
            } else {
                
                if($model->JournalNo != $decription){
                    // $modelbody[$newtrandate][$model->JournalNo] = $model->JournalNo;
                    foreach($model->get_list_T_Journaldetail() as $journaldetail){
                        // $modelbody[$newtrandate][$model->JournalNo." ~ ".$model->Description.$noref] = get_object_vars($model);
                        $modelbody[$newtrandate][$model->JournalNo." ~ ".$model->Description.$noref][$i] = 
                        $this->createJournalBody(
                            $model->TranDate,
                            $journaldetail->get_M_Chartofaccount()->Code."~".$journaldetail->get_M_Chartofaccount()->Name,
                            $journaldetail->Debet, 
                            $journaldetail->Credit
                        );
                        $i++;
                    }
                }
                $i = 0;
                $decription = $model->JournalNo;
            }
        }
        // echo json_encode($datefrom, JSON_PRETTY_PRINT);



        $data['company'] = $company;
        $data['params'] = $params;
        $data['models'] = $modelbody;
        $data['datefrom'] =  get_formated_date($datefrom, 'd F Y');
        $data['dateto'] =  get_formated_date($dateto, 'd F Y');


        if(!$ispreview){
            $html = $this->load->view('reports/journal',$data, true);
            $mpdf->SetHTMLHeader('
                <div style="text-align: right;">
                    '.$company->CompanyName.'
                </div>');
            
            $mpdf->WriteHTML($html);
            $mpdf->Output();
        } else {
            load_view('reports/preview/journal',$data);
        }

    }

    public function createJournalBody($trandate, $description, $debet, $credit){
        $data = array(
            'TranDate' => $trandate,
            'Description' => $description,
            'Debet' => $debet,
            'Credit' => $credit
        );

        return $data;

    }

    public function trialbalance_filtered_pdf($datefrom, $dateto, $ispreview){
        $CI =& get_instance();
        $mpdf = new \Mpdf\Mpdf([
            'default_font_size' => 11,
            'default_font' => 'helvetica',
            'format' => 'A4-L'
        ]);
        $company = $this->M_companies->get_list()[0];

        $DB1 = $this->load->database($this->db->database, TRUE);
        $model = array();
        $tb = $DB1->query("CALL sp_trialbalance('".$datefrom."','".$dateto."')");
       
        $params = array(
            'datefrom' => $datefrom,
            'dateto' => $dateto
        );
        
        $data['company'] = $company;
        $data['params'] = $params;
        $data['models'] = $tb->result();
        $data['datefrom'] =  get_formated_date($datefrom, 'd F Y');
        $data['dateto'] =  get_formated_date($dateto, 'd F Y');

        if(!$ispreview){
            $html = $this->load->view('reports/trialbalance',$data, true);
            $mpdf->SetHTMLHeader('
                <div style="text-align: right;">
                    '.$company->CompanyName.'
                </div>');
            
            $mpdf->WriteHTML($html);
            $mpdf->Output();
        } else {
            // $id = $_SESSION[get_variable().'languages']['Id'];
            // echo $id;
            // echo json_encode($this->G_languages->get($id));
            // echo json_encode($data);
            load_view('reports/preview/trialbalance',$data);
        }
    }

    public function generalledger_filtered_pdf($coaid, $datefrom, $dateto, $ispreview){
        $CI =& get_instance();
        $mpdf = new \Mpdf\Mpdf([
            'default_font_size' => 11,
            'default_font' => 'helvetica'
        ]);
        $company = $this->M_companies->get_list()[0];

        $DB1 = $this->load->database($this->db->database, TRUE);
        $model = array();
        $gl = $DB1->query("CALL sp_generalledger(".$coaid.",'".$datefrom."','".$dateto."')");
       
        $params = array(
            'coaid' => $coaid,
            'datefrom' => $datefrom,
            'dateto' => $dateto
        );
        
        $data['company'] = $company;
        $data['params'] = $params;
        $data['models'] = $gl->result();
        $data['datefrom'] =  get_formated_date($datefrom, 'd F Y');
        $data['dateto'] =  get_formated_date($dateto, 'd F Y');

        if(!$ispreview){
            $html = $this->load->view('reports/generalledger',$data, true);
            $mpdf->SetHTMLHeader('
                <div style="text-align: right;">
                    '.$company->CompanyName.'
                </div>');
            
            $mpdf->WriteHTML($html);
            $mpdf->Output();
        } else {
            // $id = $_SESSION[get_variable().'languages']['Id'];
            // echo $id;
            // echo json_encode($this->G_languages->get($id));
            // echo json_encode($data);
            load_view('reports/preview/generalledger',$data);
        }
    }

    public function profitloss_filtered_pdf($datefrom, $dateto, $ispreview){
        $CI =& get_instance();
        $mpdf = new \Mpdf\Mpdf([
            'default_font_size' => 11,
            'default_font' => 'helvetica'
        ]);
        $company = $this->M_companies->get_list()[0];

        $DB1 = $this->load->database($this->db->database, TRUE);
        $model = array();
        $income = $DB1->query("CALL sp_profitlostincome('".$datefrom."','".$dateto."')");
        freeDBResource($DB1->conn_id);
        $cogs = $DB1->query("CALL sp_profitlostcogs('".$datefrom."','".$dateto."')");
        freeDBResource($DB1->conn_id);
        $cost = $DB1->query("CALL sp_profitlostcost('".$datefrom."','".$dateto."')");
        freeDBResource($DB1->conn_id);
        $nonoperational = $DB1->query("CALL sp_profitlostincomenonoperational('".$datefrom."','".$dateto."')");
        freeDBResource($DB1->conn_id);
       
        $params = array(
            'datefrom' => $datefrom,
            'dateto' => $dateto
        );
        
        $data['company'] = $company;
        $data['params'] = $params;
        $data['models']['income'] = $income->result();
        $data['models']['cogs'] = $cogs->result();
        $data['models']['cost'] =$cost->result();
        $data['models']['nonoperational'] = $nonoperational->result();
        $data['datefrom'] =  get_formated_date($datefrom, 'd F Y');
        $data['dateto'] =  get_formated_date($dateto, 'd F Y');

        if(!$ispreview){
            $html = $this->load->view('reports/profitloss',$data, true);
            $mpdf->SetHTMLHeader('
                <div style="text-align: right;">
                    '.$company->CompanyName.'
                </div>');
            
            $mpdf->WriteHTML($html);
            $mpdf->Output();
        } else {
            // $id = $_SESSION[get_variable().'languages']['Id'];
            // echo $id;
            // echo json_encode($this->G_languages->get($id));
            // echo json_encode($data);
            load_view('reports/preview/profitloss',$data);
        }
    }

    public function submission_payment_pdf(){
        $status = $this->input->post('type');
        $datefrom = get_formated_date($this->input->post('datefrom'));
        $dateto = get_formated_date($this->input->post('dateto'));

        if($status == 1) {
            $this->submission_payment_summary_pdf($datefrom, $dateto);
        } else {
            $this->submission_payment_detail_pdf($datefrom, $dateto);
        }
    }

    public function submission_payment_receipt_pdf($id){
        $CI =& get_instance();
        $mpdf = new \Mpdf\Mpdf([
            'default_font_size' => 11,
            'default_font' => 'helvetica'
        ]);
        
        $company = $this->M_companies->get_list()[0];
        $people;
        $instance;
        $submissionfrom;
        $address;
        $submissionpayment = $this->T_submissionpayments->get($id);
        $submission = $submissionpayment->get_T_Submission();
        $member = $submission->get_M_Member();
        if($member->MemberType == 1){
            $people = $member->get_M_People();
            $submissionfrom = $people->CompleteName;
            $address = $people->Address;
        }
        else {
            $instance = $member->get_M_Instance();
            $submissionfrom = $instance->Owner." / ".$instance->InstanceName;
            $address = $instance->Address;
        }

        $data['company'] = $company;
        $data['submissionfrom'] = $submissionfrom;
        $data['submissionpayment'] = $submissionpayment;
        $data['address'] = $address;

        $html = $this->load->view('reports/submission_payment_receipt',$data, true);
        $mpdf->SetHTMLHeader('
            <div style="text-align: right;">
                '.$company->CompanyName.'
            </div>');
        
        $mpdf->WriteHTML($html);
        $mpdf->Output();
                      
    }

    public function submission_payment_detail_pdf($datefrom = null, $dateto = null){

        $CI =& get_instance();
        $mpdf = new \Mpdf\Mpdf([
            'default_font_size' => 11,
            'default_font' => 'helvetica'
        ]);

        $company = $this->M_companies->get_list()[0];

        $param = array(
            'where' => array(
                'ApplyDate >=' => date(get_formated_date($datefrom, 'Y-m-d')." 00:00:00"),
                'ApplyDate <=' => date(get_formated_date($dateto, 'Y-m-d')." 23:59:59")
            )
        );

        $submissions = $this->T_submissions->get_list(null, null, $param);

        $data['company'] = $company;
        $data['submissions'] = $submissions;
        $data['datefrom'] =  get_formated_date($datefrom, 'd F Y');
        $data['dateto'] =  get_formated_date($dateto, 'd F Y');

        $html = $this->load->view('reports/submission_payment_detail',$data, true);
        $mpdf->SetHTMLHeader('
            <div style="text-align: right;">
                '.$company->CompanyName.'
            </div>');
        
        $mpdf->WriteHTML($html);
        $mpdf->Output();
                      
    }

    public function submission_payment_summary_pdf($datefrom = null, $dateto = null){

        $CI =& get_instance();
        $mpdf = new \Mpdf\Mpdf([
            'default_font_size' => 11,
            'default_font' => 'helvetica'
        ]);
        $company = $this->M_companies->get_list()[0];
        $people;
        $instance;
        $submissionfrom;
        $address;

        $param = array(
            'where' => array(
                'ApplyDate >=' => date(get_formated_date($datefrom, 'Y-m-d')." 00:00:00"),
                'ApplyDate <=' => date(get_formated_date($dateto, 'Y-m-d')." 23:59:59")
            )
        );

        $submission = $this->T_submissions->get_list(null, null, $param);

        $data['company'] = $company;
        $data['submission'] = $submission;
        $data['datefrom'] =  get_formated_date($this->input->post('datefrom'), 'd F Y');
        $data['dateto'] =  get_formated_date($this->input->post('dateto'), 'd F Y');

        $html = $this->load->view('reports/submission_payment_summary',$data, true);
        $mpdf->SetHTMLHeader('
            <div style="text-align: right;">
                '.$company->CompanyName.'
            </div>');
        
        $mpdf->WriteHTML($html);
        $mpdf->Output();
                      
    }	

}