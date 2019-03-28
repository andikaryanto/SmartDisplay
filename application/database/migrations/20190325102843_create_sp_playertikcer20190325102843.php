<?php

class Migration_create_sp_playertikcer20190325102843 extends CI_Migration {

    public function up() {
        $sql = "CREATE OR REPLACE PROCEDURE sp_getplayerticker
            (
                IN PlayerName VARCHAR(100)
            )
            SELECT 	a.Id PlayerId,
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
            WHERE a.Name = 'Player_001'
                AND f.IsUpdated = 1;";
       $this->db->query($sql);
    }

    public function down() {
        $this->dbforge->drop_table('create_sp_playertikcer20190325102843');
    }

}