<?php

class Migration_create_event20190319082048 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        $this->dbforge->add_field(array(
            'Id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'Name' => array(
                'type' => 'varchar',
                'constraint' => 50,
            ),
            'Description' => array(
                'type' => 'varchar',
                'constraint' => 300,
                'null' => true
            ),
            'ActiveDate' => array(
                'type' => 'datetime',
            ),
            'InactiveDate' => array(
                'type' => 'datetime',
            ),
            'TimeStart' => array(
                'type' => 'varchar',
                'constraint' => 20,
            ),
            'TimeEnd' => array(
                'type' => 'varchar',
                'constraint' => 20,
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
        $this->dbforge->create_table('m_events', TRUE);

        $data = array('data' => array(
            'FormName' => 'm_events',
            'AliasName' => 'Even',
            'LocalName' => 'Even',
            'ClassName' => 'Master',
            'Resource' => 'ui_even',
            'IndexRoute' => 'mevent'
            )
        );
        foreach ($data as $value){
            $this->db->insert('m_forms', $value);
        }
    }

    public function down() {
        // $this->dbforge->drop_table('create_event20190319142048');
    }

}