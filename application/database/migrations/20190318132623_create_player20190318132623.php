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
                'constraint' => 25
            ),
            'IsActive' => array(
                'type' => 'Smallint',
                'constraint' => 11
            ),
            'ExpirationDate' => array(
                'type' => 'Datetime'
            ),
            'DeviceId' => array(
                'type' => 'Varchar',
                'constraint' => 50
            ),
            'IsRegistered' => array(
                'type' => 'Smallint',
                'constraint' => 11
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