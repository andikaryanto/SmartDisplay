<?php

class Migration_addcolumnmultimedia20190414103734 extends CI_Migration {

    public function up() {
        $field = array(
            'ShowTime' => array(
                'type' => 'varchar',
                'constraint' => 10,
                'null' => true,
                'after' => 'Url'
            )
        );
        $this->dbforge->add_column('m_multimedias', $field);
    }

    public function down() {
        // $this->dbforge->drop_table('addcolumnmultimedia20190414103734');
    }

}