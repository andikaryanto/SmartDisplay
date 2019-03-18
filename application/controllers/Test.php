<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Test extends CI_Controller
{
    public function index(){
        $sql ='CREATE PROCEDURE sp_generalledger(
            IN CoaId INT,
            IN StartDate DATETIME,
            IN EndDate DATETIME
        )
        SET @runtot:=0;
        SELECT *, CASE WHEN CoaType = "D" 
                THEN (@runtot := @runtot + A.Amount) 
                ELSE (@runtot := @runtot - A.Amount)
            END Saldo 
        FROM 
        (
            SELECT a.TranDate, 
                a.JournalNo, 
                SUM(b.Debet) Debet, 
                SUM(b.Credit) Credit, 
                CASE 
                    WHEN b.Debet > 0.00 THEN "D" 
                    ELSE "C"
                END CoaType,
                CASE 
                    WHEN b.Debet > 0.00 THEN b.Debet 
                    ELSE b.Credit 
                END Amount 
            FROM t_journals a
            INNER JOIN t_journaldetails b ON b.T_Journal_Id = a.Id
            INNER JOIN m_chartofaccounts c ON c.Id = b.M_Chartofaccount_Id
            WHERE c.Id = CoaId
                AND TranDate >= StartDate AND TranDate <= EndDate
            GROUP BY a.TranDate, a.JournalNo
            ORDER BY a.TranDate, a.Created
        ) A;';
        $sql= 'CREATE PROCEDURE sp_generalledger( IN CoaId INT, IN StartDate DATETIME, IN EndDate DATETIME ) SET @runtot:=0; SELECT *, CASE WHEN CoaType = "D" THEN (@runtot := @runtot + A.Amount) ELSE (@runtot := @runtot - A.Amount) END Saldo FROM ( SELECT a.TranDate, a.JournalNo, SUM(b.Debet) Debet, SUM(b.Credit) Credit, CASE WHEN b.Debet > 0.00 THEN "D" ELSE "C" END CoaType, CASE WHEN b.Debet > 0.00 THEN b.Debet ELSE b.Credit END Amount FROM t_journals a INNER JOIN t_journaldetails b ON b.T_Journal_Id = a.Id INNER JOIN m_chartofaccounts c ON c.Id = b.M_Chartofaccount_Id WHERE c.Id = CoaId AND TranDate >= StartDate AND TranDate <= EndDate GROUP BY a.TranDate, a.JournalNo ORDER BY a.TranDate, a.Created ) A;';
       $this->db->query($sql);

    }
}