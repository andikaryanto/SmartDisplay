<?php

class Migration_updatesp20190523093650 extends CI_Migration {

    public function up() {
        $sql = "CREATE OR REPLACE PROCEDURE sp_getplayerticker
            (
                IN PlayerName VARCHAR(100)
            )
            SELECT 	a.Id PlayerId,
	                d.`Id` TickerId,
                    a.Name PlayerName, 
                    f.Id PlayerTickerId,
                    d.Description TickerContent, 
                    d.Name TickerName,
                    d.`IsDeleted`,
                    e.`ActiveDate`,
                    e.`InactiveDate`,
                    e.`TimeStart`,
                    e.`TimeEnd`
            FROM m_players a
            INNER JOIN m_playertickers f ON f.M_Player_Id = a.Id
            INNER JOIN m_tickerdetails c ON c.Id = f.M_Tickerdetail_Id
            INNER JOIN m_tickers d ON d.Id = c.`M_Ticker_Id`
            INNER JOIN m_events e ON e.Id = d.`M_Event_Id`
            WHERE a.Name = PlayerName
                AND f.IsUpdated = 1;";
       $this->db->query($sql);
    }

    public function down() {
        // $this->dbforge->drop_table('updatesp20190523093650');
    }

}