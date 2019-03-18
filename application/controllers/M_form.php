<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_form extends CI_Controller
{
    private $Form;
    public function __construct()
    {
        parent::__construct();
        $this->paging->is_session_set();
        $this->Form = $this->paging->get_form_name_id();
    }

    public function index()
    {
        $form = $this->paging->get_form_name_id();
        if($this->M_groupusers->is_permitted($_SESSION[get_variable().'userdata']['M_Groupuser_Id'],$form['m_form'],'Read'))
        {

            $journallist = $this->M_formsettings->get_formsetting_by_id($this->M_forms->get_data_by_formname($this->Form['t_journal'])->Id);
            
            $data['journalmodel'] = $journallist;
            load_view('m_form/add', $data);
        }
        else
        {   
            $this->load->view('forbidden/forbidden');
        }
    }

    public function savejournal()
    {   
        
        // $formatnumber = $this->input->post('formatnumber');

        // $membermodel = $this->M_formsettings->get_form_journal_numbering_format();
        // $membermodel->StringValue = $formatnumber;
        // $membermodel->save();

        // $arrmemnumber = explode("/",$formatnumber);
        // $sequence = "";
        // for($i = 0; $i < $arrmemnumber[2] ; $i++){
        //     $sequence = $sequence."#";
        // }

        // $newnumber = $arrmemnumber[0]."/".$arrmemnumber[1]."/".$sequence;

        // $transnumber = $this->G_transactionnumbers->get_data_by_form_id($membermodel->M_Form_Id);
        // if(empty($transnumber)){
        //     $newtransnumber = $this->G_transactionnumbers->new_object();
        //     $newtransnumber->Format = $newnumber;
        //     $newtransnumber->Year = date("Y");
        //     $newtransnumber->Month = date("n");
        //     $newtransnumber->LastNumber = 0;
        //     $newtransnumber->M_Form_Id = $membermodel->M_Form_Id;
        //     $newtransnumber->save();
        // } else {
        //     $transnumber[0]->Format = $newnumber;
        //     $transnumber[0]->save();
        // }   
        
        //INCOME
        $formatnumber = $this->input->post('incomeformatnumber');

        if($formatnumber){
            $membermodel = $this->M_formsettings->get_form_journal_income_numbering_format();
            $membermodel->StringValue = $formatnumber;
            $membermodel->save();

            $arrmemnumber = explode("/",$formatnumber);
            $sequence = "";
            for($i = 0; $i < $arrmemnumber[2] ; $i++){
                $sequence = $sequence."#";
            }

            $newnumber = $arrmemnumber[0]."/".$arrmemnumber[1]."/".$sequence;

            $transnumber = $this->G_transactionnumbers->get_data_by_form_id_type($membermodel->M_Form_Id, $membermodel->TypeTrans);
            if(empty($transnumber)){
                $newtransnumber = $this->G_transactionnumbers->new_object();
                $newtransnumber->Format = $newnumber;
                $newtransnumber->Year = date("Y");
                $newtransnumber->Month = date("n");
                $newtransnumber->LastNumber = 0;
                $newtransnumber->M_Form_Id = $membermodel->M_Form_Id;
                $newtransnumber->TypeTrans = $membermodel->TypeTrans;
                $newtransnumber->save();
            } else {
                $transnumber[0]->Format = $newnumber;
                $transnumber[0]->save();
            }

        }

        //EXPENSE
        $formatnumber = $this->input->post('expenseformatnumber');

        if($formatnumber){
            $membermodel = $this->M_formsettings->get_form_journal_expense_numbering_format();
            $membermodel->StringValue = $formatnumber;
            $membermodel->save();

            $arrmemnumber = explode("/",$formatnumber);
            $sequence = "";
            for($i = 0; $i < $arrmemnumber[2] ; $i++){
                $sequence = $sequence."#";
            }

            $newnumber = $arrmemnumber[0]."/".$arrmemnumber[1]."/".$sequence;

            $transnumber = $this->G_transactionnumbers->get_data_by_form_id_type($membermodel->M_Form_Id, $membermodel->TypeTrans);
            if(empty($transnumber)){
                $newtransnumber = $this->G_transactionnumbers->new_object();
                $newtransnumber->Format = $newnumber;
                $newtransnumber->Year = date("Y");
                $newtransnumber->Month = date("n");
                $newtransnumber->LastNumber = 0;
                $newtransnumber->M_Form_Id = $membermodel->M_Form_Id;
                $newtransnumber->TypeTrans = $membermodel->TypeTrans;
                $newtransnumber->save();
            } else {
                $transnumber[0]->Format = $newnumber;
                $transnumber[0]->save();
            }

        }

        //ADJUSTMENT
        $formatnumber = $this->input->post('adjustmentformatnumber');

        if($formatnumber){
            $membermodel = $this->M_formsettings->get_form_journal_adjustment_numbering_format();
            $membermodel->StringValue = $formatnumber;
            $membermodel->save();

            $arrmemnumber = explode("/",$formatnumber);
            $sequence = "";
            for($i = 0; $i < $arrmemnumber[2] ; $i++){
                $sequence = $sequence."#";
            }

            $newnumber = $arrmemnumber[0]."/".$arrmemnumber[1]."/".$sequence;

            $transnumber = $this->G_transactionnumbers->get_data_by_form_id_type($membermodel->M_Form_Id, $membermodel->TypeTrans);
            if(empty($transnumber)){
                $newtransnumber = $this->G_transactionnumbers->new_object();
                $newtransnumber->Format = $newnumber;
                $newtransnumber->Year = date("Y");
                $newtransnumber->Month = date("n");
                $newtransnumber->LastNumber = 0;
                $newtransnumber->M_Form_Id = $membermodel->M_Form_Id;
                $newtransnumber->TypeTrans = $membermodel->TypeTrans;
                $newtransnumber->save();
            } else {
                $transnumber[0]->Format = $newnumber;
                $transnumber[0]->save();
            }

        }

        $incomedebetid = $this->input->post('incomedebetaccountid');
        $incomedebetname = $this->input->post('incomedebetaccountname');
        
        if(!empty($incomedebetid)){
            $incomedebetmodel = $this->M_formsettings->get_form_journal_income_debet_account();
            $incomedebetmodel->IntValue = $incomedebetid;
            $incomedebetmodel->StringValue = $incomedebetname;
            $incomedebetmodel->save();
        }

        
        $incomecreditid = $this->input->post('incomecreditaccountid');
        $incomecreditname = $this->input->post('incomecreditaccountname');

        
        if(!empty($incomecreditid)){
            $incomecreditmodel = $this->M_formsettings->get_form_journal_income_credit_account();
            $incomecreditmodel->IntValue = $incomecreditid;
            $incomecreditmodel->StringValue = $incomecreditname;
            $incomecreditmodel->save();
        }

        $expensedebetid = $this->input->post('expensedebetaccountid');
        $expensedebetname = $this->input->post('expensedebetaccountname');

        if(!empty($expensedebetid)){
            $expensedebetmodel = $this->M_formsettings->get_form_journal_expense_debet_account();
            $expensedebetmodel->IntValue = $expensedebetid;
            $expensedebetmodel->StringValue = $expensedebetname;
            $expensedebetmodel->save();
        }


        $expensecreditaccountid = $this->input->post('expensecreditaccountid');
        $expensecreditaccountname = $this->input->post('expensecreditaccountname');

        if(!empty($expensedebetid)){
            $expensecreditmodel = $this->M_formsettings->get_form_journal_expense_credit_account();
            $expensecreditmodel->IntValue = $expensecreditaccountid;
            $expensecreditmodel->StringValue = $expensecreditaccountname;
            $expensecreditmodel->save();
        }


        $debtdebetid = $this->input->post('debtdebetaccountid');
        $debtdebetname = $this->input->post('debtdebetaccountname');

        if(!empty($debtdebetid)){
            $debtdebetmodel = $this->M_formsettings->get_form_journal_debt_debet_account();
            $debtdebetmodel->IntValue = $debtdebetid;
            $debtdebetmodel->StringValue = $debtdebetname;
            $debtdebetmodel->save();
        }

        $debtcreditaccountid = $this->input->post('debtcreditaccountid');
        $debtcreditaccountname = $this->input->post('debtcreditaccountname');

        if(!empty($debtdebetid)){
            $debtcreditmodel = $this->M_formsettings->get_form_journal_debt_credit_account();
            $debtcreditmodel->IntValue = $debtcreditaccountid;
            $debtcreditmodel->StringValue = $debtcreditaccountname;
            $debtcreditmodel->save();
        }


        $paydebtdebetid = $this->input->post('paydebtdebetaccountid');
        $paydebtdebetname = $this->input->post('paydebtdebetaccountname');

        if(!empty($paydebtdebetid)){
            $paydebtdebetmodel = $this->M_formsettings->get_form_journal_paydebt_debet_account();
            $paydebtdebetmodel->IntValue = $paydebtdebetid;
            $paydebtdebetmodel->StringValue = $paydebtdebetname;
            $paydebtdebetmodel->save();
        }

        $paydebtcreditaccountid = $this->input->post('paydebtcreditaccountid');
        $paydebtcreditaccountname = $this->input->post('paydebtcreditaccountname');

        if(!empty($paydebtdebetid)){
            $paydebtcreditmodel = $this->M_formsettings->get_form_journal_paydebt_credit_account();
            $paydebtcreditmodel->IntValue = $paydebtcreditaccountid;
            $paydebtcreditmodel->StringValue = $paydebtcreditaccountname;
            $paydebtcreditmodel->save();
        }
        

        $receivabledebetid = $this->input->post('receivabledebetaccountid');
        $receivabledebetname = $this->input->post('receivabledebetaccountname');

        if(!empty($receivabledebetid)){
            $receivabledebetmodel = $this->M_formsettings->get_form_journal_receivable_debet_account();
            $receivabledebetmodel->IntValue = $receivabledebetid;
            $receivabledebetmodel->StringValue = $receivabledebetname;
            $receivabledebetmodel->save();
        }

        $receivablecreditaccountid = $this->input->post('receivablecreditaccountid');
        $receivablecreditaccountname = $this->input->post('receivablecreditaccountname');

        if(!empty($receivabledebetid)){
            $receivablecreditmodel = $this->M_formsettings->get_form_journal_receivable_credit_account();
            $receivablecreditmodel->IntValue = $receivablecreditaccountid;
            $receivablecreditmodel->StringValue = $receivablecreditaccountname;
            $receivablecreditmodel->save();
        }
        

        $paidreceivabledebetid = $this->input->post('paidreceivabledebetaccountid');
        $paidreceivabledebetname = $this->input->post('paidreceivabledebetaccountname');

        if(!empty($paidreceivabledebetid)){
            $paidreceivabledebetmodel = $this->M_formsettings->get_form_journal_paidreceivable_debet_account();
            $paidreceivabledebetmodel->IntValue = $paidreceivabledebetid;
            $paidreceivabledebetmodel->StringValue = $paidreceivabledebetname;
            $paidreceivabledebetmodel->save();
        }

        $paidreceivablecreditaccountid = $this->input->post('paidreceivablecreditaccountid');
        $paidreceivablecreditaccountname = $this->input->post('paidreceivablecreditaccountname');

        if(!empty($paidreceivabledebetid)){
            $paidreceivablecreditmodel = $this->M_formsettings->get_form_journal_paidreceivable_credit_account();
            $paidreceivablecreditmodel->IntValue = $paidreceivablecreditaccountid;
            $paidreceivablecreditmodel->StringValue = $paidreceivablecreditaccountname;
            $paidreceivablecreditmodel->save();
        }
        
        $capitalincreasedebetid = $this->input->post('capitalincreasedebetaccountid');
        $capitalincreasedebetname = $this->input->post('capitalincreasedebetaccountname');

        if(!empty($capitalincreasedebetid)){
            $capitalincreasedebetmodel = $this->M_formsettings->get_form_journal_capitalincrease_debet_account();
            $capitalincreasedebetmodel->IntValue = $capitalincreasedebetid;
            $capitalincreasedebetmodel->StringValue = $capitalincreasedebetname;
            $capitalincreasedebetmodel->save();
        }

        $capitalincreasecreditaccountid = $this->input->post('capitalincreasecreditaccountid');
        $capitalincreasecreditaccountname = $this->input->post('capitalincreasecreditaccountname');

        if(!empty($capitalincreasedebetid)){
            $capitalincreasecreditmodel = $this->M_formsettings->get_form_journal_capitalincrease_credit_account();
            $capitalincreasecreditmodel->IntValue = $capitalincreasecreditaccountid;
            $capitalincreasecreditmodel->StringValue = $capitalincreasecreditaccountname;
            $capitalincreasecreditmodel->save();
        }
        

        $capitalwithdrawaldebetid = $this->input->post('capitalwithdrawaldebetaccountid');
        $capitalwithdrawaldebetname = $this->input->post('capitalwithdrawaldebetaccountname');

        if(!empty($capitalwithdrawaldebetid)){
            $capitalwithdrawaldebetmodel = $this->M_formsettings->get_form_journal_capitalwithdrawal_debet_account();
            $capitalwithdrawaldebetmodel->IntValue = $capitalwithdrawaldebetid;
            $capitalwithdrawaldebetmodel->StringValue = $capitalwithdrawaldebetname;
            $capitalwithdrawaldebetmodel->save();
        }

        $capitalwithdrawalcreditaccountid = $this->input->post('capitalwithdrawalcreditaccountid');
        $capitalwithdrawalcreditaccountname = $this->input->post('capitalwithdrawalcreditaccountname');

        if(!empty($capitalwithdrawaldebetid)){
            $capitalwithdrawalcreditmodel = $this->M_formsettings->get_form_journal_capitalwithdrawal_credit_account();
            $capitalwithdrawalcreditmodel->IntValue = $capitalwithdrawalcreditaccountid;
            $capitalwithdrawalcreditmodel->StringValue = $capitalwithdrawalcreditaccountname;
            $capitalwithdrawalcreditmodel->save();
        }
        

        $assetsaledebetid = $this->input->post('assetsaledebetaccountid');
        $assetsaledebetname = $this->input->post('assetsaledebetaccountname');

        if(!empty($assetsaledebetid)){
            $assetsaledebetmodel = $this->M_formsettings->get_form_journal_assetsale_debet_account();
            $assetsaledebetmodel->IntValue = $assetsaledebetid;
            $assetsaledebetmodel->StringValue = $assetsaledebetname;
            $assetsaledebetmodel->save();
        }

        $assetsalecreditaccountid = $this->input->post('assetsalecreditaccountid');
        $assetsalecreditaccountname = $this->input->post('assetsalecreditaccountname');

        if(!empty($assetsaledebetid)){
            $assetsalecreditmodel = $this->M_formsettings->get_form_journal_assetsale_credit_account();
            $assetsalecreditmodel->IntValue = $assetsalecreditaccountid;
            $assetsalecreditmodel->StringValue = $assetsalecreditaccountname;
            $assetsalecreditmodel->save();
        }
        

        $assetpurchasedebetid = $this->input->post('assetpurchasedebetaccountid');
        $assetpurchasedebetname = $this->input->post('assetpurchasedebetaccountname');

        if(!empty($assetpurchasedebetid)){
            $assetpurchasedebetmodel = $this->M_formsettings->get_form_journal_assetpurchase_debet_account();
            $assetpurchasedebetmodel->IntValue = $assetpurchasedebetid;
            $assetpurchasedebetmodel->StringValue = $assetpurchasedebetname;
            $assetpurchasedebetmodel->save();
        }

        $assetpurchasecreditaccountid = $this->input->post('assetpurchasecreditaccountid');
        $assetpurchasecreditaccountname = $this->input->post('assetpurchasecreditaccountname');

        if(!empty($assetpurchasedebetid)){
            $assetpurchasecreditmodel = $this->M_formsettings->get_form_journal_assetpurchase_credit_account();
            $assetpurchasecreditmodel->IntValue = $assetpurchasecreditaccountid;
            $assetpurchasecreditmodel->StringValue = $assetpurchasecreditaccountname;
            $assetpurchasecreditmodel->save();
        }
        

        $assetadjustmentdebetid = $this->input->post('assetadjustmentdebetaccountid');
        $assetadjustmentdebetname = $this->input->post('assetadjustmentdebetaccountname');

        if(!empty($assetadjustmentdebetid)){
            $assetadjustmentdebetmodel = $this->M_formsettings->get_form_journal_assetadjustment_debet_account();
            $assetadjustmentdebetmodel->IntValue = $assetadjustmentdebetid;
            $assetadjustmentdebetmodel->StringValue = $assetadjustmentdebetname;
            $assetadjustmentdebetmodel->save();
        }

        $assetadjustmentcreditaccountid = $this->input->post('assetadjustmentcreditaccountid');
        $assetadjustmentcreditaccountname = $this->input->post('assetadjustmentcreditaccountname');

        if(!empty($assetadjustmentdebetid)){
            $assetadjustmentcreditmodel = $this->M_formsettings->get_form_journal_assetadjustment_credit_account();
            $assetadjustmentcreditmodel->IntValue = $assetadjustmentcreditaccountid;
            $assetadjustmentcreditmodel->StringValue = $assetadjustmentcreditaccountname;
            $assetadjustmentcreditmodel->save();
        }
        
        $successmsg = $this->paging->get_success_message();
        $this->session->set_flashdata('success_msg', $successmsg);
        redirect('mainsetup');
    }  


    public function get_income_debet_account(){
        $incomedebetmodel = $this->M_formsettings->get_form_journal_income_debet_account();
        $return = array(
            'model' => $incomedebetmodel
        );

        echo json_encode($return);
    }

    public function get_income_credit_account(){
        $incomecreditmodel = $this->M_formsettings->get_form_journal_income_credit_account();
        $return = array(
            'model' => $incomecreditmodel
        );

        echo json_encode($return);
    } 

    public function get_expense_debet_account(){
        $debet = $this->M_formsettings->get_form_journal_expense_debet_account();
        $return = array(
            'model' => $debet
        );

        echo json_encode($return);
    }

    public function get_expense_credit_account(){
        $credit = $this->M_formsettings->get_form_journal_expense_credit_account();
        $return = array(
            'model' => $credit
        );

        echo json_encode($return);
    }

    public function get_debt_debet_account(){
        $debet = $this->M_formsettings->get_form_journal_debt_debet_account();
        $return = array(
            'model' => $debet
        );

        echo json_encode($return);
    }

    public function get_debt_credit_account(){
        $credit = $this->M_formsettings->get_form_journal_debt_credit_account();
        $return = array(
            'model' => $credit
        );

        echo json_encode($return);
    }

    public function get_paydebt_debet_account(){
        $debet = $this->M_formsettings->get_form_journal_paydebt_debet_account();
        $return = array(
            'model' => $debet
        );

        echo json_encode($return);
    }

    public function get_paydebt_credit_account(){
        $credit = $this->M_formsettings->get_form_journal_paydebt_credit_account();
        $return = array(
            'model' => $credit
        );

        echo json_encode($return);
    }

    public function get_receivable_debet_account(){
        $debet = $this->M_formsettings->get_form_journal_receivable_debet_account();
        $return = array(
            'model' => $debet
        );

        echo json_encode($return);
    }

    public function get_receivable_credit_account(){
        $credit = $this->M_formsettings->get_form_journal_receivable_credit_account();
        $return = array(
            'model' => $credit
        );

        echo json_encode($return);
    }

    public function get_paidreceivable_debet_account(){
        $debet = $this->M_formsettings->get_form_journal_paidreceivable_debet_account();
        $return = array(
            'model' => $debet
        );

        echo json_encode($return);
    }

    public function get_paidreceivable_credit_account(){
        $credit = $this->M_formsettings->get_form_journal_paidreceivable_credit_account();
        $return = array(
            'model' => $credit
        );

        echo json_encode($return);
    }

    public function get_capitalincrease_debet_account(){
        $debet = $this->M_formsettings->get_form_journal_capitalincrease_debet_account();
        $return = array(
            'model' => $debet
        );

        echo json_encode($return);
    }

    public function get_capitalincrease_credit_account(){
        $credit = $this->M_formsettings->get_form_journal_capitalincrease_credit_account();
        $return = array(
            'model' => $credit
        );

        echo json_encode($return);
    }

    public function get_capitalwithdrawal_debet_account(){
        $debet = $this->M_formsettings->get_form_journal_capitalwithdrawal_debet_account();
        $return = array(
            'model' => $debet
        );

        echo json_encode($return);
    }

    public function get_capitalwithdrawal_credit_account(){
        $credit = $this->M_formsettings->get_form_journal_capitalwithdrawal_credit_account();
        $return = array(
            'model' => $credit
        );

        echo json_encode($return);
    }

    public function get_assetsale_debet_account(){
        $debet = $this->M_formsettings->get_form_journal_assetsale_debet_account();
        $return = array(
            'model' => $debet
        );

        echo json_encode($return);
    }

    public function get_assetsale_credit_account(){
        $credit = $this->M_formsettings->get_form_journal_assetsale_credit_account();
        $return = array(
            'model' => $credit
        );

        echo json_encode($return);
    }

    public function get_assetpurchase_debet_account(){
        $debet = $this->M_formsettings->get_form_journal_assetpurchase_debet_account();
        $return = array(
            'model' => $debet
        );

        echo json_encode($return);
    }

    public function get_assetpurchase_credit_account(){
        $credit = $this->M_formsettings->get_form_journal_assetpurchase_credit_account();
        $return = array(
            'model' => $credit
        );

        echo json_encode($return);
    }
    public function get_assetadjustment_debet_account(){
        $debet = $this->M_formsettings->get_form_journal_assetadjustment_debet_account();
        $return = array(
            'model' => $debet
        );

        echo json_encode($return);
    }

    public function get_assetadjustment_credit_account(){
        $credit = $this->M_formsettings->get_form_journal_assetadjustment_credit_account();
        $return = array(
            'model' => $credit
        );

        echo json_encode($return);
    }
}