<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class T_journals_model extends MY_Model {

    public function __construct(){
        parent::__construct();
    }

    public function validate($model, $oldmodel = null){
        $warning  = array();

        if($model->Amount == 0.00)
            $warning = array_merge($warning, array(0=>'err_msg_amount_must_greaterthan_zero'));
        if(empty($model->Description))
            $warning = array_merge($warning, array(0=>'err_msg_description_cannot_null'));

        return $warning;
    }

    public function getBeginningBalance(){
        $begbalance = $this->new_object();
        $begbalance->Id = 0;
        $begbalance->JournalNo = lang('ui_beginningbalance');
        $begbalance->TranDate = '2019-01-01 00:00:00';
        $begbalance->Description = lang('ui_beginningbalance');
        return $begbalance;
    }

}

class T_journal_object extends Model_object {
   
    public function getCoaDebet(){
        $CI =& get_instance();
        $CI->load->model(array('M_chartofaccounts'));

        $coadebet = $CI->M_chartofaccounts->get($this->CoaDebet_Id);
        if($coadebet)
            return $coadebet;
        return $CI->M_chartofaccounts->new_object();

    }

    public function getCoaCredit(){
        $CI =& get_instance();
        $CI->load->model(array('M_chartofaccounts'));

        $coacredit = $CI->M_chartofaccounts->get($this->CoaCredit_Id);
        if($coacredit)
            return $coacredit;
        return $CI->M_chartofaccounts->new_object();

    }

    public function saveWithDetail(){
        $CI =& get_instance();
        $CI->load->model(array('T_journaldetails'));

        $newid = $this->save();

        $details = $this->get_list_T_journaldetail();
        // echo json_encode($this);
        // echo $newid;
        if(!empty($details)){
            foreach($details as $detail){
                $detail->delete();
            }
        } 

        $debet = $CI->T_journaldetails->new_object();
        $debet->T_Journal_Id = $newid;
        $debet->Debet = $this->Amount;
        $debet->M_Chartofaccount_Id = $this->CoaDebet_Id;
        $debet->Type = "D";
        $debet->Credit = 0.00;
        $debet->Order = 1;
        $debet->save();

        $credit = $CI->T_journaldetails->new_object();
        $credit->T_Journal_Id = $newid;
        $credit->Debet = 0.00;
        $credit->Credit = $this->Amount;
        $credit->M_Chartofaccount_Id = $this->CoaCredit_Id;
        $credit->Type = "C";
        $credit->Order = 2;     
        $credit->save();

    }

    public function getPaidAmount(){
        $CI =& get_instance();
        $CI->load->model(array('T_journals'));

        $amount = 0.00;
        $params = array(
            'where' => array(
                'Refno' => $this->JournalNo
            )
        );

        $results = $CI->T_journals->get_list(null, null, $params);
        foreach($results as $result){
            $amount += $result->Amount;
        }

        return $amount;
    }

    public function getOutstandingAmount(){
        return $this->Amount - $this->getPaidAmount();
    }

    public function getTypeTrans(){
        if($this->Type == 1) {
            return typeTrans_enum()['income'];
        } else if($this->Type == 2) {
            return typeTrans_enum()['expense'];
        } else {
            return typeTrans_enum()['other'];
        }
    }
}