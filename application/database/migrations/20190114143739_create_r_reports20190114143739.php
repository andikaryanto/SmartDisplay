<?php

class Migration_create_r_reports20190114143739 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        $this->dbforge->add_field(array(
            'Id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'Name' => array(
                'type' => 'Varchar',
                'constraint' => 300
            ),
            'Description' => array(
                'type' => 'Varchar',
                'constraint' => 300
            ),
            'Url' => array(
                'type' => 'Varchar',
                'constraint' => 1000
            ),
            'Resource' => array(
                'type' => 'Varchar',
                'constraint' => 1000,
                'null' => true
            )
        ));
        $this->dbforge->add_key('Id', TRUE);
        $this->dbforge->create_table('r_reports', TRUE);
    }

    public function down() {
        $this->dbforge->drop_table('r_reports');
    }

}