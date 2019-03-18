<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_groupusers_model extends MY_Model {

    public function __construct(){
        parent::__construct();
    }
    
    public function delete_data($id)
    {
        $this->db->where('Id', $id);
        if(!$this->db->delete('m_groupusers')){
            return $this->db->error();
        }
        else{
            return;
        }
    }

    public function is_data_exist($groupname = null)
    {
        $exist = false;
        if($this->count(array('GroupName'=> $groupname)) > 0){
            $exist = true;
        }
        return $exist;
    }

    public function validate($model, $oldmodel = null)
    {
        $nameexist = false;
        $warning = array();
        if(!empty($oldmodel))
        {
            if($model->GroupName != $oldmodel->GroupName)
            {
                $nameexist = $this->is_data_exist($model->GroupName);
            }
        }
        else{
            if(!empty($model->GroupName))
            {
                $nameexist = $this->is_data_exist($model->GroupName);
            }
            else{
                $warning = array_merge($warning, array(0=>'ui_msg_group_name_can_not_null'));
            }
        }
        if($nameexist)
        {
            $warning = array_merge($warning, array(0=>'err_msg_name_exist'));
        }
        
        return $warning;
    }

    
    public function has_role($groupid, $formid, $role)
    {
        $permitted = false;
        $this->db->select('*');
        $this->db->from('m_accessroles');
        $this->db->where('M_Groupuser_Id', $groupid);
        $this->db->where('M_Form_Id', $formid);
        $this->db->where($role, 1);
        $query = $this->db->get();
        $result = $query->row();
        if($result)
        {
            $permitted = true;
        }

        return $permitted;
    }

    public function is_permitted($groupid = null, $form = null, $role = null)
    {
        $formid = $form;
        if(isset($form)){
            $forms = $this->M_forms->get_data_by_formname($form);
            $formid = $forms->Id;
        }
        
        $permitted = false;
        if($this->paging->is_superadmin($_SESSION[get_variable().'userdata']['Username'])
            ||  $this->has_role($groupid,$formid,$role)
        )
        {
            $permitted = true;
        }
        return $permitted;
    }

    public function is_reportpermitted($groupid = null, $report = null, $role = null)
    {
        $reportid = $report;
        if(isset($report)){
            $reports = $this->R_reports->get_data_by_name($report);
            $reportid = $reports->Id;
        }
        
        $permitted = false;
        if($this->paging->is_superadmin($_SESSION[get_variable().'userdata']['Username'])
            ||  $this->has_role($groupid,$reportid,$role)
        )
        {
            $permitted = true;
        }
        return $permitted;
    }
    
}

class M_groupuser_object extends Model_object {

    public function View_m_accessrole(){
        $CI = get_instance();
        $CI->db->select('*');
        $CI->db->from('view_m_accessroles');
        $CI->db->group_start();
        $CI->db->where('GroupId', $this->Id);
        // $CI->db->where_not_in('FormId', array('3','4','5','6','8'));
        // $CI->db->where_not_in('ClassName', 'Report');
        $CI->db->group_end();
        $CI->db->or_where('GroupId', null);
        // $CI->db->where('ClassName !=', 'Report');
        // $CI->db->group_start();
        // $CI->db->group_end();
        $CI->db->order_by('ClassName', 'ASC');
        $CI->db->order_by('Header', 'DESC');
        $CI->db->order_by('FormName', 'ASC');
        $query =$CI->db->get();
        
        return $query->result();
    }

    public function View_r_reportaccessrole(){
        $CI = get_instance();
        $CI->db->select('*');
        $CI->db->from('view_r_reportaccessroles');
        $CI->db->group_start();
        $CI->db->where('GroupId', $this->Id);
        // $CI->db->where('ClassName', 'Report');
        $CI->db->group_end();
        // $CI->db->or_where('GroupId', null);
        // $CI->db->where('ClassName', 'Report');
        // // $CI->db->group_start();
        // // $CI->db->group_end();
        // $CI->db->order_by('ClassName', 'ASC');
        // $CI->db->order_by('Header', 'DESC');
        // $CI->db->order_by('FormName', 'ASC');
        $query =$CI->db->get();
        
        return $query->result();
    }
}