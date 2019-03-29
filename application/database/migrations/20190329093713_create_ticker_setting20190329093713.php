<?php

class Migration_create_ticker_setting20190329093713 extends CI_Migration {

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
            'BackGroundColor' => array(
                'type' => 'Varchar',
                'constraint' => 10
            ),
            'FontColor' => array(
                'type' => 'Varchar',
                'constraint' => 10
            ),
            'Height' => array(
                'type' => 'Varchar',
                'constraint' => 10
            ),
            'Speed' => array(
                'type' => 'Int',
                'constraint' => 11
            ),
            'ImgUrl' => array(
                'type' => 'Varchar',
                'constraint' => 500
            ),
            'IsActive' => array(
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
        $this->dbforge->create_table('m_tickersettings');

        $data = array('data' => array(
            'FormName' => 'm_tickersettings',
            'AliasName' => 'Ticker',
            'LocalName' => 'Ticker',
            'ClassName' => 'Setup',
            'Resource' => 'ui_ticker',
            'IndexRoute' => 'mtickersetting'
            )
        );
        foreach ($data as $value){
            $this->db->insert('m_forms', $value);
        }
    }

    public function down() {
        // $this->dbforge->drop_table('create_ticker_setting20190329093713');
    }

}