<?php

class Migration_recreate_m_form_setting20190110215426 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        $this->dbforge->add_field(array(
            'Id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'M_Form_Id' => array(
                'type' => 'INT',
                'constraint' => 11
            ),
            'Value' => array (
                'type' => 'INT',
                'constraint' => 11
            ),
            'Name' => array (
                'type' => 'VARCHAR',
                'constraint' => 1000
            ),
            'IntValue' => array (
                'type' => 'INT',
                'constraint' => 11,
                'null' => true
            ),
            'StringValue' => array (
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true
            ),
            'DecimalValue' => array (
                'type' => 'Decimal',
                'constraint' => '18,2',
                'null' => true
            ),
            'DateTimeValue' => array (
                'type' => 'DATETIME',
                'null' => true
            ),
            'BooleanValue' => array (
                'type' => 'SMALLINT',
                'constraint' => 11,
                'null' => true
            ),
            

        ));
        $this->dbforge->add_key('Id', TRUE);
        $this->dbforge->create_table('m_formsettings', TRUE);
        $this->db->query(add_foreign_key('m_formsettings', 'M_Form_Id', 'm_forms(Id)', 'RESTRICT', 'CASCADE'));
    }

    public function down() {
        //$this->dbforge->drop_table('recreate_m_form_setting20190110215426');
    }

}