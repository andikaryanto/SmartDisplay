<?php

class Migration_create_m_userprofiles20190116143925 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        $this->dbforge->add_field(array(
            'Id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'M_User_Id' => array(
                'type' => 'INT',
                'constraint' => 11
            ),
            'CompleteName' => array(
                'type' => 'Varchar',
                'constraint' => 300,
                'null' => true
            ),
            'Address' => array(
                'type' => 'Varchar',
                'constraint' => 300,
                'null' => true
            ),
            'Phone'  => array(
                'type' => 'Varchar',
                'constraint' => 20,
                'null' => true
            ),
            'Email'  => array(
                'type' => 'Varchar',
                'constraint' => 20,
                'null' => true
            ),
            'PhotoPath' => array(
                'type' => 'Varchar',
                'constraint' => 300,
                'null' => true
            ),
            'PhotoName'  => array(
                'type' => 'Varchar',
                'constraint' => 300,
                'null' => true
            ),
            'AboutMe'  => array(
                'type' => 'Varchar',
                'constraint' => 1000,
                'null' => true
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
        $this->dbforge->create_table('m_userprofiles', true);
        $this->db->query(add_foreign_key('m_userprofiles', 'M_User_Id', 'm_users(Id)', 'CASCADE', 'CASCADE'));
    }

    public function down() {
        //$this->dbforge->drop_table('create_m_userprofiles20190116143925');
    }

}