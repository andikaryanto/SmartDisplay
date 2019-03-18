<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_users_model extends MY_Model {

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('M_groupusers');
    }

    public function get_sigle_data_user($username, $password)
    {
        $md5pass = encryptMd5(get_variable().$username.$password);


        $params = array(
            'where' => array(
                'Username'=> $username,
                'Password'=> $md5pass,
                'IsActive'=> 1
            )
        );

       return $this->get(null, null, $params);
    }

    public function saveNewPassword($username, $password, $newPassword){
        
        $md5pass = encryptMd5(get_variable().$username.$password);
        $newmd5pass = encryptMd5(get_variable().$username.$newPassword);
        $this->db->set('Password', $newmd5pass);
        $this->db->where('Password', $md5pass);
        $this->db->update('m_users');
    }

    public function is_data_exist($name = null)
    {
        $exist = false;
        $this->db->select('*');
        $this->db->from('m_users');
        $this->db->where('Username', $name);
        $query = $this->db->get();

        $row = $query->result();
        if(count($row) > 0){
            $exist = true;
        }
        return $exist;
    }

    public function validate($model, $oldmodel= null)
    {
        $nameexist  = false;
        $warning    = array();

        if(!empty($oldmodel))
        {
            if($model->Username != $oldmodel->Username)
            {
                $nameexist = $this->is_data_exist($model->Username);
            }
        }
        else{
            if(!empty($model->Username))
            {
                $nameexist = $this->is_data_exist($model->Username);
            }
            else{
                $warning = array_merge($warning, array(0=>'err_msg_name_can_not_null'));
            }
        }

        if($nameexist)
            $warning = array_merge($warning, array(0=>'err_msg_name_exist'));

        if(empty($model->M_Groupuser_Id))
            $warning = array_merge($warning, array(0=>'err_msg_groupuser_can_not_null'));

        if(empty($model->Password))
            $warning = array_merge($warning, array(0=>'err_msg_password_can_not_null'));

        
        return $warning;
    }

    public function validate_changepassword($username, $oldpassword, $newpassword, $confirmpassword){
        $warning = array();
        $datauser = $this->get_sigle_data_user($username, $oldpassword);
        if($datauser){
            if($newpassword != $confirmpassword){
                $warning = array_merge($warning, array(0=>'err_wrong_confirmed_password'));
            }
        } else {
            $warning = array_merge($warning, array(0=>'err_wrong_password'));
        }
        return $warning;

    }   
    
}

class M_user_object extends Model_object {

    public function save_with_detail(){

        $id = $this->save();
        $this->save_settings($id);
        $this->save_profile($id);
        return $id;
    }

    public function setPassword($password){
        $this->Password = encryptMd5(get_variable().$this->Username.$password);
    }

    public function save_settings($id){
        $CI =& get_instance();
        $CI->load->model(array('M_usersettings'));
        $user_settings = $CI->M_usersettings->new_object();
        $user_settings->M_User_Id = $id;
        $user_settings->G_Language_Id = 1;
        $user_settings->G_Color_Id = 1;
        $user_settings->RowPerpage = 5;
        //print_r($user_settings);
        $user_settings->save();
    }

    public function save_profile($id){
        $CI =& get_instance();
        $user_profile = $CI->M_userprofiles->new_object();
        $user_profile->M_User_Id = $id;
        $user_profile->PhotoPath = "./assets/user_profile/";
        $user_profile->PhotoName = "user_default.png";
        $user_profile->save();
    }

}