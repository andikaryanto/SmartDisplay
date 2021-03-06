<?php

class Migration_create_multimedia20190319125307 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        $this->dbforge->add_field(array(
            'Id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'M_Event_Id' => array(
                'type' => 'INT',
                'constraint' => 11
            ),
            'Name' => array(
                'type' => 'varchar',
                'constraint' => 300
            ),
            'Type' => array(
                'type' => 'SMALLINT',
                'constraint' => 11
            ),
            'AssignType' => array(
                'type' => 'SMALLINT',
                'constraint' => 11
            ),
            'Url' => array(
                'type' => 'varchar',
                'constraint' => 500,
            ),
            'ActiveDate' => array(
                'type' => 'datetime',
                'null' => true
            ),
            'InactiveDate' => array(
                'type' => 'datetime',
                'null' => true
            ),
            'IsDeleted' => array (
                'type' => 'smallint',
                'constraint' => 11
            ),
            'CreatedBy' => array(
                'type' => 'varchar',
                'constraint' => 50,
                'null' => true
            ),
            'ModifiedBy' => array(
                'type' => 'varchar',
                'constraint' => 50,
                'null' => true
            ),
            'Created' => array(
                'type' => 'datetime',
                'null' => true
            ),
            'Modified' => array(
                'type' => 'datetime',
                'null' => true
            )

        ));
        $this->dbforge->add_key('Id', TRUE);
        $this->dbforge->create_table('m_multimedias', TRUE);
        $this->db->query(add_foreign_key('m_multimedias', 'M_Event_Id', 'm_events(Id)', 'RESTRICT', 'CASCADE'));
    }

    public function down() {
        // $this->dbforge->drop_table('create_multimedia20190319125307');
    }

}