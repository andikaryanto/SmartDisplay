<?php

class Migration_add_column_fomrsetting20190222150138 extends CI_Migration {

    public function up() {
        $field = array(
            'TypeTrans' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'after' => 'M_Form_Id'
            )
        );
        $this->dbforge->add_column('m_formsettings', $field);
    }

    public function down() {
        // $this->dbforge->drop_table('add_column_fomrsetting20190222150138');
    }

}