<?php

class Migration_create_g_transactionumber20190104103204 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        $this->dbforge->add_field(array(
            'Id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'Format' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
            ),
            'Year' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'Month' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'LastNumber' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'M_Form_Id' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
        
        ));
        $this->dbforge->add_key('Id', TRUE);
        $this->dbforge->create_table('g_transactionnumbers');
    }

    public function down() {
        //$this->dbforge->drop_table('create_g_transactionumber20190104103204');
    }

}