<?php

class Migration_create_player_multimedia20190325110212 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        $this->dbforge->add_field(array(
            'Id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'PlayerId' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'PlayerName' => array(
                'type' => 'Varchar',
                'constraint' => 100,
            ),
            'MultimediaId' => array(
                'type' => 'Varchar',
                'constraint' => 100,
            ),
            'Url' => array(
                'type' => 'Varchar',
                'constraint' => 500,
            ),
            'MultimediaName' => array(
                'type' => 'Varchar',
                'constraint' => 500,
            ),
            'IsDeleted' => array(
                'type' => 'smallint',
                'constraint' => 11,
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
            'DownloadedUrl' => array(
                'type' => 'Varchar',
                'constraint' => 500,
            ),
        ));
        $this->dbforge->add_key('Id', TRUE);
        $this->dbforge->create_table('t_playermultimedias');
    }

    public function down() {
        // $this->dbforge->drop_table('create_player_multimedia20190325110212');
    }

}