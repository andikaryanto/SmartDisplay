<?php

class Migration_create_group_player20190318090044 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        $this->dbforge->add_field(array(
            'Id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            )
        ));
        $this->dbforge->add_key('Id', TRUE);
        $this->dbforge->create_table('m_groupplayers');
    }

    public function down() {
        // $this->dbforge->drop_table('create_group_player20190318090044');
    }

}