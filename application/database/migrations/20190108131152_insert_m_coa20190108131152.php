<?php

class Migration_insert_m_coa20190108131152 extends CI_Migration {

    public function up() {
       
        // $field = array(
        //     'Type' => array(                
        //         'type' => 'INT',
        //         'constraint' => 11,
        //         'after' => 'Level',
        //         'null' => false
        // ));
        // $this->dbforge->add_column('m_chartofaccounts', $field);

        // $datadetail = array('data'=> 
        //     array(
        //         'Code' => '1000',
        //         'Name' => 'Aktiva',
        //         'Level' => 1,
        //         'Type' => 1
        //     ), array(
        //         'Code' => '2000',
        //         'Name' => 'Pasiva',
        //         'Level' => 1,
        //         'Type' => 2
        //     ),
        // );

        // foreach ($datadetail as $value){
        //     $this->db->insert('m_chartofaccounts', $value);
        // }
    }

    public function down() {
        //$this->dbforge->drop_table('insert_m_coa20190108131152');
    }

}