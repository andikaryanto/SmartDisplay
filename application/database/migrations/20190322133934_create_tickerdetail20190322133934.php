<?php

class Migration_create_tickerdetail20190322133934 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        $this->dbforge->add_field(array(
            'Id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'M_Ticker_Id' => array(
                'type' => 'INT',
                'constraint' => 11
            ),
            'M_Player_Id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => true
            ),
            'M_Groupplayer_Id' => array(
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
        $this->dbforge->create_table('m_tickerdetails', TRUE);
        $this->db->query(add_foreign_key('m_tickerdetails', 'M_Ticker_Id', 'm_tickers(Id)', 'RESTRICT', 'CASCADE'));
        $this->db->query(add_foreign_key('m_tickerdetails', 'M_Player_Id', 'm_players(Id)', 'RESTRICT', 'CASCADE'));
        $this->db->query(add_foreign_key('m_tickerdetails', 'M_Groupplayer_Id', 'm_groupplayers(Id)', 'RESTRICT', 'CASCADE'));
    
    }

    public function down() {
        // $this->dbforge->drop_table('create_tickerdetail20190322133934');
    }

}