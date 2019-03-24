<?php

class Migration_create_player_multimdia20190324110233 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        $this->dbforge->add_field(array(
            'Id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'M_Multimediadetail_Id' => array(
                'type' => 'INT',
                'constraint' => 11
            ),
            'M_Player_Id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => true
            ),
            'IsUpdated' => array (
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
        $this->dbforge->create_table('m_playermultimedias');
        $this->db->query(add_foreign_key('m_playermultimedias', 'M_Multimediadetail_Id', 'm_multimediadetails(Id)', 'RESTRICT', 'CASCADE'));
        $this->db->query(add_foreign_key('m_playermultimedias', 'M_Player_Id', 'm_players(Id)', 'RESTRICT', 'CASCADE'));
    }

    public function down() {
        // $this->dbforge->drop_table('create_player_multimdia20190324110233');
    }

}