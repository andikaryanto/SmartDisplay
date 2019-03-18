<?php

class Migration_create_view_r_reportacessroles20190129133334 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        $sql = "CREATE OR REPLACE VIEW view_r_reportaccessroles
                as
                SELECT a.Id AS GroupId,
                    b.Id AS ReportId, 
                    b.Name AS ReportName,
                    b.Resource,
                    IFNULL(c.Read,0) AS Readd,
                    IFNULL(c.Write,0) AS Writee,
                    IFNULL(c.Delete,0) AS Deletee,
                    IFNULL(c.Print,0) AS Printt
                FROM ((m_groupusers a JOIN r_reports b) 
                LEFT JOIN r_reportaccessroles c ON(((c.R_Report_Id = b.Id) 
                    AND (c.M_Groupuser_Id = a.Id)))) 
                ORDER BY b.Name";
        $query = $this->db->query($sql);
    }

    public function down() {
        // $this->dbforge->drop_table('create_view_r_reportacessroles20190129133334');
    }

}