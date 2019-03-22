<?php

class Migration_insert_form20190322110851 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        $data = array('data' => array(
            'FormName' => 'm_tickers',
            'AliasName' => 'Master',
            'LocalName' => 'Master',
            'ClassName' => 'Master',
            'Resource' => 'ui_ticker',
            'IndexRoute' => 'mticker'
            )
        );
        foreach ($data as $value){
            $this->db->insert('m_forms', $value);
        }
    }

    public function down() {
        // $this->dbforge->drop_table('insert_form20190322110851');
    }

}