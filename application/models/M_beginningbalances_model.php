<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_beginningbalances_model extends MY_Model {

    public function __construct(){
        parent::__construct();
    }

    
    public function is_data_exist($coaid = null)
    {
        $exist = false;
        if($this->count(array('M_Chartofaccount_Id'=> $coaid)) > 0){
            $exist = true;
        }
        return $exist;
    }

    public function validate($model, $oldmodel = null){
        $nameexist = false;
        $warning = array();
        if(!empty($oldmodel))
        {
            if($model->M_Chartofaccount_Id != $oldmodel->M_Chartofaccount_Id)
            {
                $nameexist = $this->is_data_exist($model->M_Chartofaccount_Id);
            }
        }
        else{
            if(!empty($model->M_Chartofaccount_Id))
            {
                $nameexist = $this->is_data_exist($model->M_Chartofaccount_Id);
            }
            else{
                $warning = array_merge($warning, array(0=>'err_msg_acount_code_can_not_null'));
            }
        }
        if($nameexist)
        {
            $warning = array_merge($warning, array(0=>'err_msg_acount_code_exist'));
        }
        
        return $warning;
    }
    
    public function isExistBeginningBalance($coaid = null){
        if($coaid != null){
            $this->db->select_sum('Amount');
            $this->db->where('M_Chartofaccount_Id', $coaid);
            $query = $this->db->get('m_beginningbalances')->row();
            if($query->Amount > 0.00){
                return true;
            }
            return false;
        } else {
            $this->db->select_sum('Amount');
            $query = $this->db->get('m_beginningbalances')->row();
            if($query->Amount > 0.00){
                return true;
            }
            return false;
        }
    }

    public function getSumBegBalance(){
        $query = $this->db->query(
            "SELECT (
                SELECT SUM(
                CASE WHEN b.Attribute = '-' THEN b.Amount * -1 ELSE b.Amount END
                ) Debet
                
                FROM m_chartofaccounts a
                INNER JOIN  m_beginningbalances b ON b.M_Chartofaccount_Id = a.Id
                WHERE a.CodeInt < 3000000000 
                    AND b.type = 'D'
            )Debet, (
            SELECT SUM(
                CASE WHEN b.Attribute = '-' THEN b.Amount * -1 ELSE b.Amount END
                ) Debet
                
                FROM m_chartofaccounts a
                INNER JOIN  m_beginningbalances b ON b.M_Chartofaccount_Id = a.Id
                WHERE a.CodeInt < 3000000000 
                    AND b.type = 'C'
            ) Credit");
        
        $result = $query->row();
        return $result;

    }

    public function isBalance(){
        $result = $this->getSumBegBalance();
        if($result->Debet != $result->Credit){
            return false;
        }

        return true;
    }

    public function getNotBalanceModel(){
        if(!$this->isBalance()){
            
            $result = $this->getSumBegBalance();
            return array(
                'result' => array(
                    'D' => 'D',
                    'AmountDebet' => $result->Debet,
                    'C' => 'K',
                    'AmountCredit' => $result->Credit
                    
                )
            );
        }
        return array();
    }

}

class M_beginningbalance_object extends Model_object {
   
    public function getType(){
        $type = "C";
        $coa = $this->get_M_Chartofaccount();
        if(($coa->CodeInt >= 1000000000 && $coa->CodeInt < 2000000000) || 
            ($coa->CodeInt >= 3000010102 && $coa->CodeInt < 5000000000) || 
            ($coa->CodeInt >= 6000000000)
          )
        {
            $type = "D";
        }

        return $type;
    }

    public function getAttribute(){
        $attr = "+";
        $coa = $this->get_M_Chartofaccount();
        if($coa->CodeInt >= 1000020200 && $coa->CodeInt < 2000000000) 
        {
            $attr = "-";
        }

        return $attr;
    }

    

}