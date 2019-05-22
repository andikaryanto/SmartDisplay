<?php

class Migration_alter20190414105825 extends CI_Migration {

    public function up() {
        $sql = "CREATE OR REPLACE PROCEDURE sp_getplayermultimedia
        (
            IN PlayerName VARCHAR(100)
        )
            SELECT 	a.Id PlayerId,
		            f.Id PlayerMultimediaId,
                    a.Name PlayerName, 
		            d.Id MultimediaId,
                    d.Url, 
                    d.ShowTime, 
                    d.Type MultimediaType, 
                    d.Name MultimediaName,
                    d.`IsDeleted`,
                    CAST(e.`ActiveDate` AS DATE) ActiveDate,
                    CAST(e.`InactiveDate`AS DATE) InactiveDate,
                    e.`TimeStart`,
                    e.`TimeEnd`
            FROM m_players a
            INNER JOIN m_playermultimedias f ON f.M_Player_Id = a.Id
            INNER JOIN m_multimediadetails c ON c.Id = f.M_Multimediadetail_Id
            INNER JOIN m_multimedias d ON d.Id = c.`M_Multimedia_Id`
            INNER JOIN m_events e ON e.Id = d.`M_Event_Id`
            WHERE a.Name = PlayerName
                AND f.IsUpdated = 1;";
   $this->db->query($sql);
    }

    public function down() {
        $this->dbforge->drop_table('alter20190414105825');
    }

}