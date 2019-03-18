<?php

class Migration_insert_form20190318091354 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        $data = array('data' => array(
            'FormName' => 'm_groupplayers',
            'AliasName' => 'Group Player',
            'LocalName' => 'Player Grup',
            'ClassName' => 'Master',
            'Resource' => 'ui_groupplayer',
            'IndexRoute' => 'mgroupplayer'
            )
        );
        foreach ($data as $value){
            $this->db->insert('m_forms', $value);
        }
    }

    public function down() {
        // $this->dbforge->drop_table('insert_form20190318091354');
    }

}