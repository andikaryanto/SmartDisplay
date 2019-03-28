<?php

class Migration_create_t_ticker20190328134255 extends CI_Migration {

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
            'TickerId' => array(
                'type' => 'Varchar',
                'constraint' => 100,
            ),
            'TickerContent' => array(
                'type' => 'Varchar',
                'constraint' => 500,
            ),
            'TickerName' => array(
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
            )
        ));
        $this->dbforge->add_key('Id', TRUE);
        $this->dbforge->create_table('t_playertickers');
    }

    public function down() {
        // $this->dbforge->drop_table('create_t_ticker20190328134255');
    }

}