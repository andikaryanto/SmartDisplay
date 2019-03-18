<?php

class Migration_insert_m_form extends CI_Migration {

    private $table = 'm_forms';
    public function up() {
        $this->load->helper('db_helper');
        //$data = array();
        $data = array('data' =>
            array(
                'FormName' => 'm_groupusers',
                'AliasName' => 'master group user',
                'LocalName' => 'master grup pengguna',
                'ClassName' => 'Master',
                'Resource' => 'ui_groupuser',
                'IndexRoute' => 'mgroupuser'
            ),
            array(
                'FormName' => 'm_users',
                'AliasName' => 'master user',
                'LocalName' => 'master pengguna',
                'ClassName' => 'Master',
                'Resource' => 'ui_user',
                'IndexRoute' => 'muser'
            )
        );
        foreach ($data as $value){
            $this->db->insert($this->table, $value);
        }
    }

    public function down() {
        //$this->dbforge->drop_table('insert_m_form');
    }

}