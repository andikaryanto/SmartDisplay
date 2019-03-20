<?php

class Migration_create_player20190318132623 extends CI_Migration {

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
                'constraint' => 50
            ),
            'M_Groupplayer_Id' => array(
                'type' => 'INT',
                'constraint' => 11
            ),
            'IpAddress' => array(
                'type' => 'Varchar',
                'constraint' => 25,
                'null' => true
            ),
            'IsActive' => array(
                'type' => 'Smallint',
                'constraint' => 11
            ),
            'ExpirationDate' => array(
                'type' => 'Datetime',
                'null' => true
            ),
            'DeviceId' => array(
                'type' => 'Varchar',
                'constraint' => 50,
                'null' => true
            ),
            'IsRegistered' => array(
                'type' => 'Smallint',
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
        $this->dbforge->create_table('m_players', TRUE);
        $this->db->query(add_foreign_key('m_players', 'M_Groupplayer_Id', 'm_groupplayers(Id)', 'RESTRICT', 'CASCADE'));
    
    }

    public function down() {
        // $this->dbforge->drop_table('create_player20190318132623');
    }

}