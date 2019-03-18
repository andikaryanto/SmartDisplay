<?php

class Migration_insert_m_form20190110113848 extends CI_Migration {

    public function up() {
        $data = array('data' => array(
                'FormName' => 'm_forms',
                'AliasName' => 'Setup',
                'LocalName' => 'Pengaturan',
                'ClassName' => 'Setup',
                'Resource' => 'ui_mainsetup',
                'IndexRoute' => 'mainsetup'
            )
        );
        foreach ($data as $value){
            $this->db->insert('m_forms', $value);
        }
    }

    public function down() {
        //$this->dbforge->drop_table('insert_m_form20190110113848');
    }

}