<?php

class Migration_insert_form20190320084920 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        $data = array('data' => array(
            'FormName' => 'm_multimedias',
            'AliasName' => 'Multimedia',
            'LocalName' => 'Multimedia',
            'ClassName' => 'Multimedia',
            'Resource' => 'ui_multimedia',
            'IndexRoute' => 'mmultimedia'
            )
        );
        foreach ($data as $value){
            $this->db->insert('m_forms', $value);
        }
    }

    public function down() {
        // $this->dbforge->drop_table('insert_form20190320084920');
    }

}