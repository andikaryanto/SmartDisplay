<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_chartofaccounts_model extends MY_Model {

    public function __construct(){
        parent::__construct();
    }

    public function getIncomeAccount(){
        $params = array(
            'where' => array(
                'CodeInt >=' => 3000000000,
                'CodeInt <' => 3000010200
            )
        );

        return $this->get_list(null, null, $params);
    }

    public function getCashBankAccount(){
        $params = array(    
            'where' => array(
                'CodeInt >=' => 1000010100,
                'CodeInt <' => 1000010200
            )
        );

        return $this->get_list(null, null, $params);
    }

    public function getCostAccount(){
        $params = array(
            'where' => array(
                'CodeInt >=' => 4000000000,
                'CodeInt <' => 5000000000
            )
        );

        return $this->get_list(null, null, $params);
    }

    public function getCOGSAccount(){
        $params = array(
            'where' => array(
                'CodeInt >=' => 3000010200,
                'CodeInt <' => 4000000000
            )
        );

        return $this->get_list(null, null, $params);
    }

    public function getPayableAccount(){
        $params = array(
            'where' => array(
                'CodeInt >=' => 2000000000,
                'CodeInt <' => 2000020000
            )
        );

        return $this->get_list(null, null, $params);
    }

    public function getReceivableAccount(){
        $params = array(
            'where' => array(
                'CodeInt >=' => 1000010200,
                'CodeInt <' => 1000010300
            )
        );

        return $this->get_list(null, null, $params);
    }

    public function getCapitalAccount(){
        $params = array(
            'where' => array(
                'CodeInt >=' => 2000020000,
                'CodeInt <' => 2000020200
            )
        );

        return $this->get_list(null, null, $params);
    }

    public function getAssetAccount(){
        $params = array(
            'where' => array(
                'CodeInt >=' => 1000020000,
                'CodeInt <' => 1000020200
            )
        );

        return $this->get_list(null, null, $params);
    }

    public function getInventoryAccount(){
        $params = array(
            'where' => array(
                'CodeInt >=' => 1000010300,
                'CodeInt <' => 1000010400
            )
        );

        return $this->get_list(null, null, $params);
    }

    public function getMaxType(){
        $this->db->select_max('Type');
        return $this->db->get('m_chartofaccounts')->row()->Type;
    }

    public function is_data_exist($code = null)
    {
        $exist = false;
        // $data = $this->M_chartofaccounts->get_list(null, null, array('where'=>array('Code'=> $code)));
        if($this->count(null, array('where'=>array('Code'=> $code))) > 0){
            $exist = true;
        }
        return $exist;
    }

    public function validate($model, $oldmodel = null){
        $nameexist  = false;
        $warning    = array();

        if(!empty($oldmodel))
        {
            if($model->Code != $oldmodel->Code)
            {
                $nameexist = $this->is_data_exist($model->Code);
            }
        }
        else{
            if(!empty($model->Code))
            {
                $nameexist = $this->is_data_exist($model->Code);
            }
            else{
                $warning = array_merge($warning, array(0=>'err_msg_acount_code_can_not_null'));
            }
        }

        if($nameexist == 1)
            $warning = array_merge($warning, array(0=>'err_msg_acount_code_exist'));

        return $warning;
    }

    public function createDumpAccount(){
        $coa = $this->new_object();
        $coa->Id = 9999;
        $coa->Code = '7000';
        $coa->Name = 'Dump Account';
        $coa->Type = 7;
        $coa->Level = 1;
    }

}

class M_chartofaccount_object extends Model_object {

    public function __get($name){
        switch($name){
            case "IsParent" :
                return $this->isParent();
            case "IsLowLevel" :
                return $this->isLowLevel();
            case "DownLevel" :
                return $this->downLevel();
        }
    }

    public function M_Parent(){
        $CI =& get_instance();
        if($this->Parent){
            $parent = $CI->M_chartofaccounts->get($this->Parent);
            if($parent){
                return $parent;
            }
        }
        return $CI->M_chartofaccounts->new_object();
    }

    public function downLevel(){
        return $this->Level - 1;
    }

    public function isParent(){
        $CI =& get_instance();
        $params = array(
            'where' => array(
                'Parent' => $this->Id
            )
        );
        $parent = $CI->M_chartofaccounts->get_list(null, null, $params);
        if($parent){
            return true;
        }
        return false;
    }

    public function isLowLevel(){
        if(!$this->IsParent)
            return true;
        return false;
    }

    public function getCodeInt(){

        $CI =& get_instance();
        $CI->load->model(array('M_chartofaccounts'));

        $codeInt = 0;
        $parent =$CI->M_chartofaccounts->get($this->Parent);
        $newcode="";
        $splitcode = explode(".", $this->Code);
        foreach($splitcode as $split){
            $newcode .= $split;
        }

        if(strlen($newcode) == 4){
            $codeStr = $newcode."000000";
            $codeInt = $codeStr;
        } else if (strlen($newcode) == 6){
            $codeStr = $newcode."0000";
            $codeInt = $codeStr;
        } else if (strlen($newcode) == 8){
            $codeStr = $newcode."00";
            $codeInt = $codeStr;
        } else if (strlen($newcode) > 8){
            $codeStr = $newcode;
            $codeInt = $codeStr;
        }

        return $codeInt;
    }

    public function getOriginalCode(){
        $splitcode = explode(".", $this->Code);
        if(empty($this->Code))
            return "";
        return $splitcode[count($splitcode)-1];
    }

    public function getNextChildCode(){
        $CI =& get_instance();
        $CI->load->model(array('M_chartofaccounts'));
        $nextcode = '01';
        if(isset($this->Id)){
            $params = array(
                'where' => array(
                    'Parent' => $this->Id,
                    
                ),
                'order' => array(
                    'CodeInt' => 'DESC'
                )
            );
            $data = $CI->M_chartofaccounts->get(null, null, $params);
            if($data){
                $arrLastcode = explode(".",$data->Code);
                $lastcode = $arrLastcode[count($arrLastcode) - 1];
                $intNextCode = (int)$lastcode + 1;
                $nextcode = substr("00".$intNextCode, 1, 2);
            }
        }

        return $nextcode;
    }
   
    public function getDefault(){
        $type = "C";
        $coa = $this;
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
        $coa = $this;
        if($coa->CodeInt >= 1000020200 && $coa->CodeInt < 2000000000) 
        {
            $attr = "-";
        }

        return $attr;
    }
}