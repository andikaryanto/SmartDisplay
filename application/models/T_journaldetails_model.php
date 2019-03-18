<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class T_journaldetails_model extends MY_Model {

    public function __construct(){
        parent::__construct();
    }

    public function validate($model, $oldmodel = null){
        //validate goes here
    }

    public function getBeginningBalance(){
        $arrbegbalance = array();
        $beginingnalances = $this->M_beginningbalances->get_list();
        $debet = 0.00;
        $credit = 0.00;
        if($beginingnalances)
        {
            foreach($beginingnalances as $beginingnalance){
                if($beginingnalance->Amount > 0.00){
                    $begbalance = $this->new_object();
                    $begbalance->Id = 0;
                    $begbalance->T_Journal_Id = 0;
                    $begbalance->M_Chartofaccount_Id = $beginingnalance->M_Chartofaccount_Id;
                    $begbalance->Type = $beginingnalance->Type;
                    if($beginingnalance->Type == "D"){
                        if($beginingnalance->Attribute == "-"){
                            $begbalance->Debet = -1 * $beginingnalance->Amount;
                        } else {
                            $begbalance->Debet = $beginingnalance->Amount;
                        }
                        $debet += $begbalance->Debet;
                    } else {
                        $begbalance->Credit = $beginingnalance->Amount;
                        $credit += $begbalance->Credit;
                    }
                    array_push($arrbegbalance, $begbalance);
                }
            }
        }

        $dumbcoa = $this->M_chartofaccounts->createDumpAccount();
        $dumbbalance = $this->new_object();
        if($debet > $credit != 0.00){
            $dumbbalance->Type = 'D';
            $dumbbalance->Credit = $debet - $credit;
            array_push($arrbegbalance, $dumbbalance);
        } elseif  ($credit > $debet){
            $dumbbalance->Type = 'C';
            $dumbbalance->Debet = $credit - $debet;
            array_push($arrbegbalance, $dumbbalance);
        }

        return $arrbegbalance;
    }

    

}

class T_journaldetail_object extends Model_object {
   
}