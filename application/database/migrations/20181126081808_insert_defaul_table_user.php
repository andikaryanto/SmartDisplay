<?php

class Migration_insert_defaul_table_user extends CI_Migration {

    private $table = 'm_users';
    public function up() {
        $data = [
            'Username' => 'superadmin',
            'Password' => '1e2acca1abae9a7e0dd64a901adea2e5'
        ];
        $this->db->insert($this->table, $data);

    }

    public function down() {
        //$this->dbforge->drop_table('insert_defaul_table_user');
    }

}