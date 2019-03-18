<?php

class Migration_create_m_company20190110093633 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        $this->dbforge->add_field(array(
            'Id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'CompanyName' => array(
                'type' => 'VARCHAR',
                'constraint' => 50
            ),
            'Address' => array(
                'type' => 'VARCHAR',
                'constraint' => 300
            ),
            'PostCode' => array(
                'type' => 'VARCHAR',
                'constraint' => 10
            ),
            'Email' => array(
                'type' => 'VARCHAR',
                'constraint' => 300
            ),
            'Phone' => array(
                'type' => 'VARCHAR',
                'constraint' => 50
            ),
            'Fax' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
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
        $this->dbforge->create_table('m_companies');

        $data = array('data' => array(
                'FormName' => 'm_companies',
                'AliasName' => 'Perusahaan',
                'LocalName' => 'Company',
                'ClassName' => 'Setup',
                'Resource' => 'ui_company',
                'IndexRoute' => 'mcompany'
            )
        );
        foreach ($data as $value){
            $this->db->insert('m_forms', $value);
        }
    }

    public function down() {
        //$this->dbforge->drop_table('create_m_company20190110093633');
    }

}