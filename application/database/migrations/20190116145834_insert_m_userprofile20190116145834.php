<?php

class Migration_insert_m_userprofile20190116145834 extends CI_Migration {

    public function up() {
        $dataSetting = [
            'M_User_Id' => '1',
            'PhotoPath' => "./assets/user_profile/",
            'PhotoName' => "user_default.png"
        ];
        
        $this->db->insert('m_userprofiles', $dataSetting);
    }

    public function down() {
    }

}