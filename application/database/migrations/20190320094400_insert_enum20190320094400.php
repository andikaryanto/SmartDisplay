<?php

class Migration_insert_enum20190320094400 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        $data = array('data' =>
                
            array(
                'Name' => 'MultimediaType'
            ),
            array(
                'Name' => 'MultimediaAssignType'
            ),
        );
        foreach ($data as $value){
            $this->db->insert('m_enums', $value);
        }

        $data = array('data' =>
            
            array(
                'M_Enum_Id' => 2,
                'Value' => 1,
                'EnumName' => 'Image',
                'Ordering' => 1,
                'Resource' => 'ui_image'
            ),
            array(
                'M_Enum_Id' => 2,
                'Value' => 2,
                'EnumName' => 'Video',
                'Ordering' => 2,
                'Resource' => 'ui_video'
            ),
            array(
                'M_Enum_Id' => 3,
                'Value' => 1,
                'EnumName' => 'Many Players',
                'Ordering' => 1,
                'Resource' => 'ui_manyplayers'
            ),
            array(
                'M_Enum_Id' => 3,
                'Value' => 2,
                'EnumName' => 'Group Player',
                'Ordering' => 2,
                'Resource' => 'ui_groupplayer'
            )
        );
        foreach ($data as $value){
            $this->db->insert('m_enumdetails', $value);
        }
    }

    public function down() {
        // $this->dbforge->drop_table('insert_enum20190320094400');
    }

}