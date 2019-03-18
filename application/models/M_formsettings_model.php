<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_formsettings_model extends MY_Model {

    private $Form;
    public function __construct(){
        parent::__construct();
        
        $this->Form = $this->paging->get_form_name_id();
    }

    public function validate($model, $oldmodel = null){
        //validate goes here
    }


    //MEMBER JOURNAL
    public function get_form_journal_numbering_format(){
        $forms = $this->M_forms->get_data_by_formname($this->Form['t_journal']);
        $params = array(
            'where' => array(
                'M_Form_Id' => $forms->Id,
                'Name' => 'NUMBERING_FORMAT'
            )
        );

        return $this->get_list(null, null, $params)[0];
    }

    public function get_form_journal_income_numbering_format(){
        $forms = $this->M_forms->get_data_by_formname($this->Form['t_journal']);
        $params = array(
            'where' => array(
                'M_Form_Id' => $forms->Id,
                'Name' => 'NUMBERING_FORMAT',
                'TypeTrans' => 1
            )
        );

        return $this->get_list(null, null, $params)[0];
    }    

    public function get_form_journal_expense_numbering_format(){
        $forms = $this->M_forms->get_data_by_formname($this->Form['t_journal']);
        $params = array(
            'where' => array(
                'M_Form_Id' => $forms->Id,
                'Name' => 'NUMBERING_FORMAT',
                'TypeTrans' => 2
            )
        );

        return $this->get_list(null, null, $params)[0];
    }    

    public function get_form_journal_adjustment_numbering_format(){
        $forms = $this->M_forms->get_data_by_formname($this->Form['t_journal']);
        $params = array(
            'where' => array(
                'M_Form_Id' => $forms->Id,
                'Name' => 'NUMBERING_FORMAT',
                'TypeTrans' => 3
            )
        );

        return $this->get_list(null, null, $params)[0];
    }

    public function get_form_journal_income_debet_account(){
        $forms = $this->M_forms->get_data_by_formname($this->Form['t_journal']);
        $params = array(
            'where' => array(
                'M_Form_Id' => $forms->Id,
                'Name' => 'INCOME_DEBET_ACCOUNT'
            )
        );

        return $this->get_list(null, null, $params)[0];
    }

    public function get_form_journal_income_credit_account(){
        $forms = $this->M_forms->get_data_by_formname($this->Form['t_journal']);
        $params = array(
            'where' => array(
                'M_Form_Id' => $forms->Id,
                'Name' => 'INCOME_CREDIT_ACCOUNT'
            )
        );

        return $this->get_list(null, null, $params)[0];
    }
    
    public function get_form_journal_expense_debet_account(){
        $forms = $this->M_forms->get_data_by_formname($this->Form['t_journal']);
        $params = array(
            'where' => array(
                'M_Form_Id' => $forms->Id,
                'Name' => 'EXPENSE_DEBET_ACCOUNT'
            )
        );

        return $this->get_list(null, null, $params)[0];
    }

    public function get_form_journal_expense_credit_account(){
        $forms = $this->M_forms->get_data_by_formname($this->Form['t_journal']);
        $params = array(
            'where' => array(
                'M_Form_Id' => $forms->Id,
                'Name' => 'EXPENSE_CREDIT_ACCOUNT'
            )
        );

        return $this->get_list(null, null, $params)[0];
    }

    public function get_form_journal_debt_debet_account(){
        $forms = $this->M_forms->get_data_by_formname($this->Form['t_journal']);
        $params = array(
            'where' => array(
                'M_Form_Id' => $forms->Id,
                'Name' => 'DEBT_DEBET_ACCOUNT'
            )
        );

        return $this->get_list(null, null, $params)[0];
    }

    public function get_form_journal_debt_credit_account(){
        $forms = $this->M_forms->get_data_by_formname($this->Form['t_journal']);
        $params = array(
            'where' => array(
                'M_Form_Id' => $forms->Id,
                'Name' => 'DEBT_CREDIT_ACCOUNT'
            )
        );

        return $this->get_list(null, null, $params)[0];
    }

    public function get_form_journal_paydebt_debet_account(){
        $forms = $this->M_forms->get_data_by_formname($this->Form['t_journal']);
        $params = array(
            'where' => array(
                'M_Form_Id' => $forms->Id,
                'Name' => 'PAY_DEBT_DEBET_ACCOUNT'
            )
        );

        return $this->get_list(null, null, $params)[0];
    }

    public function get_form_journal_paydebt_credit_account(){
        $forms = $this->M_forms->get_data_by_formname($this->Form['t_journal']);
        $params = array(
            'where' => array(
                'M_Form_Id' => $forms->Id,
                'Name' => 'PAY_DEBT_CREDIT_ACCOUNT'
            )
        );

        return $this->get_list(null, null, $params)[0];
    }

    public function get_form_journal_receivable_debet_account(){
        $forms = $this->M_forms->get_data_by_formname($this->Form['t_journal']);
        $params = array(
            'where' => array(
                'M_Form_Id' => $forms->Id,
                'Name' => 'RECEIVABLE_DEBET_ACCOUNT'
            )
        );

        return $this->get_list(null, null, $params)[0];
    }

    public function get_form_journal_receivable_credit_account(){
        $forms = $this->M_forms->get_data_by_formname($this->Form['t_journal']);
        $params = array(
            'where' => array(
                'M_Form_Id' => $forms->Id,
                'Name' => 'RECEIVABLE_CREDIT_ACCOUNT'
            )
        );

        return $this->get_list(null, null, $params)[0];
    }

    public function get_form_journal_paidreceivable_debet_account(){
        $forms = $this->M_forms->get_data_by_formname($this->Form['t_journal']);
        $params = array(
            'where' => array(
                'M_Form_Id' => $forms->Id,
                'Name' => 'PAID_RECEIVABLE_DEBET_ACCOUNT'
            )
        );

        return $this->get_list(null, null, $params)[0];
    }

    public function get_form_journal_paidreceivable_credit_account(){
        $forms = $this->M_forms->get_data_by_formname($this->Form['t_journal']);
        $params = array(
            'where' => array(
                'M_Form_Id' => $forms->Id,
                'Name' => 'PAID_RECEIVABLE_CREDIT_ACCOUNT'
            )
        );

        return $this->get_list(null, null, $params)[0];
    }

    public function get_form_journal_capitalincrease_debet_account(){
        $forms = $this->M_forms->get_data_by_formname($this->Form['t_journal']);
        $params = array(
            'where' => array(
                'M_Form_Id' => $forms->Id,
                'Name' => 'CAPITAL_INCREASE_DEBET_ACCOUNT'
            )
        );

        return $this->get_list(null, null, $params)[0];
    }

    public function get_form_journal_capitalincrease_credit_account(){
        $forms = $this->M_forms->get_data_by_formname($this->Form['t_journal']);
        $params = array(
            'where' => array(
                'M_Form_Id' => $forms->Id,
                'Name' => 'CAPITAL_INCREASE_CREDIT_ACCOUNT'
            )
        );

        return $this->get_list(null, null, $params)[0];
    }

    public function get_form_journal_capitalwithdrawal_debet_account(){
        $forms = $this->M_forms->get_data_by_formname($this->Form['t_journal']);
        $params = array(
            'where' => array(
                'M_Form_Id' => $forms->Id,
                'Name' => 'CAPITAL_WITHDRAWAL_DEBET_ACCOUNT'
            )
        );

        return $this->get_list(null, null, $params)[0];
    }

    public function get_form_journal_capitalwithdrawal_credit_account(){
        $forms = $this->M_forms->get_data_by_formname($this->Form['t_journal']);
        $params = array(
            'where' => array(
                'M_Form_Id' => $forms->Id,
                'Name' => 'CAPITAL_WITHDRAWAL_CREDIT_ACCOUNT'
            )
        );

        return $this->get_list(null, null, $params)[0];
    }

    public function get_form_journal_assetsale_debet_account(){
        $forms = $this->M_forms->get_data_by_formname($this->Form['t_journal']);
        $params = array(
            'where' => array(
                'M_Form_Id' => $forms->Id,
                'Name' => 'ASSET_SALE_DEBET_ACCOUNT'
            )
        );

        return $this->get_list(null, null, $params)[0];
    }

    public function get_form_journal_assetsale_credit_account(){
        $forms = $this->M_forms->get_data_by_formname($this->Form['t_journal']);
        $params = array(
            'where' => array(
                'M_Form_Id' => $forms->Id,
                'Name' => 'ASSET_SALE_CREDIT_ACCOUNT'
            )
        );

        return $this->get_list(null, null, $params)[0];
    }

    public function get_form_journal_assetpurchase_debet_account(){
        $forms = $this->M_forms->get_data_by_formname($this->Form['t_journal']);
        $params = array(
            'where' => array(
                'M_Form_Id' => $forms->Id,
                'Name' => 'ASSET_PURCHASE_DEBET_ACCOUNT'
            )
        );

        return $this->get_list(null, null, $params)[0];
    }

    public function get_form_journal_assetpurchase_credit_account(){
        $forms = $this->M_forms->get_data_by_formname($this->Form['t_journal']);
        $params = array(
            'where' => array(
                'M_Form_Id' => $forms->Id,
                'Name' => 'ASSET_PURCHASE_CREDIT_ACCOUNT'
            )
        );

        return $this->get_list(null, null, $params)[0];
    }

    public function get_form_journal_assetadjustment_debet_account(){
        $forms = $this->M_forms->get_data_by_formname($this->Form['t_journal']);
        $params = array(
            'where' => array(
                'M_Form_Id' => $forms->Id,
                'Name' => 'ASSET_ADJUSTMENT_DEBET_ACCOUNT'
            )
        );

        return $this->get_list(null, null, $params)[0];
    }

    public function get_form_journal_assetadjustment_credit_account(){
        $forms = $this->M_forms->get_data_by_formname($this->Form['t_journal']);
        $params = array(
            'where' => array(
                'M_Form_Id' => $forms->Id,
                'Name' => 'ASSET_ADJUSTMENT_CREDIT_ACCOUNT'
            )
        );

        return $this->get_list(null, null, $params)[0];
    }

    /** END*/
    public function get_formsetting_by_id($id){
        $params = array(
            'where' => array(
                'M_Form_Id' => $id
            ),
            'order' => array(
                'Value' => 'ASC'
            )
        );

        return $this->get_list(null, null, $params);
    }
}

class M_formsetting_object extends Model_object {
   
}