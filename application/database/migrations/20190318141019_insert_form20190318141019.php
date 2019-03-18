<?php

class Migration_insert_form20190318141019 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        $data = array('data' => array(
            'FormName' => 'm_players',
            'AliasName' => 'Player',
            'LocalName' => 'Player',
            'ClassName' => 'Master',
            'Resource' => 'ui_player',
            'IndexRoute' => 'mplayer'
            )
        );
        foreach ($data as $value){
            $this->db->insert('m_forms', $value);
        }
    }

    public function down() {
        // $this->dbforge->drop_table('insert_form20190318141019');
    }

}