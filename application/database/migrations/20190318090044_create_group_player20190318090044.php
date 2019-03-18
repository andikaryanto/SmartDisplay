<?php

class Migration_create_group_player20190318090044 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        $this->dbforge->add_field(array(
            'Id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'GroupName' => array(
                'type' => 'varchar',
                'constraint' => 100
            ),
            'Description' => array(
                'type' => 'varchar',
                'constraint' => 300
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
        $this->dbforge->create_table('m_groupplayers', TRUE);
    }

    public function down() {
        // $this->dbforge->drop_table('create_group_player20190318090044');
    }

}