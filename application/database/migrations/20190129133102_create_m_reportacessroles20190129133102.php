<?php

class Migration_create_m_reportacessroles20190129133102 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        
        $this->dbforge->add_field(array(
            'Id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'R_Report_Id' => array(
                'type' => 'INT',
                'constraint' => 11
            ),
            'M_Groupuser_Id' => array(
                'type' => 'INT',
                'constraint' => 11
            ),
            'Read' => array(
                'type' => 'TINYINT',
                'constraint' => 1
            ),
            'Write' => array(
                'type' => 'TINYINT',
                'constraint' => 1
            ),
            'Delete' => array(
                'type' => 'TINYINT',
                'constraint' => 1
            ),
            'Print' => array(
                'type' => 'TINYINT',
                'constraint' => 1
            ),
        ));
        $this->dbforge->add_key('Id', TRUE);
        $this->dbforge->create_table('r_reportaccessroles', TRUE);
        $this->db->query(add_foreign_key('r_reportaccessroles', 'M_Groupuser_Id', 'm_groupusers(Id)', 'CASCADE', 'CASCADE'));
        $this->db->query(add_foreign_key('r_reportaccessroles', 'R_Report_Id', 'r_reports(Id)', 'RESTRICT', 'CASCADE'));
        
    }

    public function down() {
        // $this->dbforge->drop_table('m_accessrole');
    }

}