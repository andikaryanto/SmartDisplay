<?php

class Migration_insert_m_forms20190114145930 extends CI_Migration {

    public function up() {
        $data = array('data' => array(
            'FormName' => 'r_reports',
            'AliasName' => 'Report',
            'LocalName' => 'Laporan',
            'ClassName' => 'Report',
            'Resource' => 'ui_report',
            'IndexRoute' => 'report'
        )
    );
    foreach ($data as $value){
        $this->db->insert('m_forms', $value);
    }
    }

    public function down() {
    }

}