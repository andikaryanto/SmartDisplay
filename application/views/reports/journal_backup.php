<?php
    include APPPATH.'views/template/reportheader.php';

    $totaldebet=0.00;
    $totalcredit=0.00;
?>
<table border = "0">
    <tr>
        <td align = "right" colspan="30">
            <?= $company->Address?>
        </td>
    </tr>
    <tr>
        <td align = "right" colspan="30">
            <?= $company->Phone?>
        </td>
    </tr>
    <tr>
        <td align = "right" colspan="30">
            <?= $company->Email?>
        </td>
    </tr>
    <tr>
        <td height ="70" colspan="28" valign = "bottom">
            <strong style="font-size: 20px;"><?= lang('report_journal')?></strong>
        </td>
        <td align = "right" colspan="2">
            <!-- <strong style="font-size: 20px;"><?= lang('ui_receipt')?></strong> -->
        </td>
    </tr>
    <tr>
        <td style = "width:20%">
            <div class = "table-title"><?= lang('ui_datefrom')?></strong>
        </td>
        <td >
            <div class = "table-title"><?= ": ".$datefrom ?></strong>
        </td>
    </tr>
    <tr>
        <td style = "width:20%">
            <div class = "table-title"><?= lang('ui_dateto')?></strong>
        </td>
        <td >
            <div class = "table-title"><?= ": ".$dateto ?></strong>
        </td>
    </tr>
    
</table>
<div style ="color: #fff">"a"</div>
<table  border = "0">
    <tr style = "background-color:#99ff99;">
        <th height ="25">
            <?= lang('ui_date')?>
        </th>
        <th align = "left" height ="25">
            <?= lang('ui_description')?>
        </th>
        <th align = "left">
            <?= lang('ui_debet')?>
        </th>
        <th align = "right">
            <?= lang('ui_credit')?>
        </th>
    </tr>
    <?php 
     $totaldebet=0.00;
     $totalcredit=0.00;
     if($this->M_beginningbalances->isExistBeginningBalance()){
         $begbalance = $this->T_journals->getBeginningBalance();
    ?>
     <tr>
     <td height ="25" align = "center"></td>
        <td align = "left"><b><?= $begbalance->JournalNo?></b></td>
     </tr>
    <?php
         foreach($this->T_journaldetails->getBeginningBalance() as $balancedetail){
    ?>
         <tr>
            <td height ="25" align = "center"><?= get_formated_date($begbalance->TranDate, 'd-M-Y') ?></td>
            <td align = "left"><?= $balancedetail->get_M_Chartofaccount()->Code."~".$balancedetail->get_M_Chartofaccount()->Name?></td>
            <td align = "right"><?= number_format($balancedetail->Debet, 2, ",", ".")?></td>
            <td align = "right"><?= number_format($balancedetail->Credit, 2, ",", ".")?></td>
         </tr>
    <?php
 
             $totaldebet += $balancedetail->Debet;
             $totalcredit += $balancedetail->Credit;
         }
     }
    foreach($models as $model) {
        $noref = "";
        if(!empty($model->Refno))
            $noref = " ( Ref. ".$model->Refno." )";
    ?>

    <tr>
        <td height ="25" align = "center"></td>
        <td align = "left"><b><?= "No. ".$model->JournalNo." ~ ".$model->Description.$noref?></b></td>
    </tr>
    <?php 
     foreach($model->get_list_T_Journaldetail() as $detail){
    ?>
    <tr>
        <td height ="25" align = "center"><?= get_formated_date($model->TranDate, 'd-M-Y') ?></td>
        <td align = "left"><?= $detail->get_M_Chartofaccount()->Code."~".$detail->get_M_Chartofaccount()->Name?></td>
        <td align = "right"><?= number_format($detail->Debet, 2, ",", ".")?></td>
        <td align = "right"><?= number_format($detail->Credit, 2, ",", ".")?></td>
    
    </tr>
    <?php

        $totaldebet += $detail->Debet;
        $totalcredit += $detail->Credit;
        // $totalfinepayment += $value->FinePayment;
        // $totalratepayment += $value->RatePayment;
        // $total += $value->Amount;
     }
    }
    ?>
</table>
<!-- <div style ="border-bottom: solid">"a"</div> -->
<div style ="color:#fff; border-top: solid; border-top-color:grey; padding: 0px 0;">"a"</div>
<table border = "0">
   
    <tr >
        <td align = "left" style = "width:80%">
           <h3> <?=lang('ui_total'). "  :"?></h3>
        </td>
        <td align = "right" style ="border-bottom: solid; border-bottom-color:grey;">
            <h3><?= number_format($totaldebet, 2, ",", ".")?></h3>
        </td>
        <td align = "right" style ="border-bottom: solid; border-bottom-color:grey;">
            <h3><?= number_format($totalcredit, 2, ",", ".")?></h3>
        </td>
    </tr>
</table> 

