<?php
    include APPPATH.'views/template/reportheader.php';

    $begbaltotaldebet=0.00;
    $begbaltotalcredit=0.00;
    $totaldebet=0.00;
    $totalcredit=0.00;
    $baltotaldebet=0.00;
    $baltotalcredit=0.00;
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
            <strong style="font-size: 20px;"><?= lang('report_trialbalance')?></strong>
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
        <th width  = "35%" height ="25" align = "left">
            <?= lang('ui_description')?>
        </th>
        <th align = "right">
            
        </th>
        <th align = "right">
            <?= lang('ui_beginningbalance')?>
        </th>
        <th align = "right">
           
        </th>
        <th align = "right">
            <?= lang('ui_transaction')?>
        </th>
        <th align = "right">
           
        </th>
        <th align = "right">
            <?= lang('ui_balance')?>
        </th>
    </tr>
    <tr style = "background-color:#99ff99;">
        <th height ="25" >
            
        </th>
        <th align = "right">
            <?= lang('ui_debet')?>
        </th>
        <th align = "right">
            <?= lang('ui_credit')?>
        </th>
        <th align = "right">
            <?= lang('ui_debet')?>
        </th>
        <th align = "right">
            <?= lang('ui_credit')?>
        </th>
        <th align = "right">
            <?= lang('ui_debet')?>
        </th>
        <th align = "right">
            <?= lang('ui_credit')?>
        </th>
    </tr>
    <?php 
    
    foreach($models as $model) {
    ?>
    <tr>
        <td height ="25" align = "left"><?= $model->Code." ~ " .$model->Name?></td>
        <?php 
        if($model->BegBalanceDebet < 0.00) {
        ?> 
            <td align = "right"><?= "(". number_format(abs($model->BegBalanceDebet), 2, ",", ".") . ")"?></td> 
        <?php 
         } else {
        ?>
            <td align = "right"><?= number_format($model->BegBalanceDebet, 2, ",", ".") ?></td> 

         <?php }
        ?> 
        <?php 
        if($model->BegBalanceCredit < 0.00) {
        ?> 
            <td align = "right"><?= "(". number_format(abs($model->BegBalanceCredit), 2, ",", ".") . ")"?></td> 
        <?php 
         } else {
        ?>
            <td align = "right"><?= number_format($model->BegBalanceCredit, 2, ",", ".") ?></td> 

         <?php }
        ?> 
        <?php 
        if($model->Debet < 0.00) {
        ?> 
            <td align = "right"><?= "(". number_format(abs($model->Debet), 2, ",", ".") . ")"?></td> 
        <?php 
         } else {
        ?>
            <td align = "right"><?= number_format($model->Debet, 2, ",", ".") ?></td> 

         <?php }
        ?> 
        <?php 
        if($model->Credit < 0.00) {
        ?> 
            <td align = "right"><?= "(". number_format(abs($model->Credit), 2, ",", ".") . ")"?></td> 
        <?php 
         } else {
        ?>
            <td align = "right"><?= number_format($model->Credit, 2, ",", ".") ?></td> 

         <?php }
        ?> 
        <?php 
        if($model->BalanceDebet < 0.00) {
        ?> 
            <td align = "right"><?= "(". number_format(abs($model->BalanceDebet), 2, ",", ".") . ")"?></td> 
        <?php 
         } else {
        ?>
            <td align = "right"><?= number_format($model->BalanceDebet, 2, ",", ".") ?></td> 

         <?php }
        ?> 
        <?php 
        if($model->BalanceCredit < 0.00) {
        ?> 
            <td align = "right"><?= "(". number_format(abs($model->BalanceCredit), 2, ",", ".") . ")"?></td> 
        <?php 
         } else {
        ?>
            <td align = "right"><?= number_format($model->BalanceCredit, 2, ",", ".") ?></td> 

         <?php }
        ?> 
    
    </tr>
    <?php

        $begbaltotaldebet += $model->BegBalanceDebet;
        $begbaltotalcredit += $model->BegBalanceCredit;
        $totaldebet += $model->Debet;
        $totalcredit += $model->Credit;
        $baltotaldebet += $model->BalanceDebet;
        $baltotalcredit += $model->BalanceCredit;
    }
    ?>
    <tr>
        <td align = "left"><b><?=lang('ui_total'). "  :"?></b></td>
        <?php 
        if($begbaltotaldebet < 0.00) {
        ?> 
            <td align = "right"><b><?= "(". number_format(abs($begbaltotaldebet), 2, ",", ".") . ")"?></b></td> 
        <?php 
         } else {
        ?>
            <td align = "right"><b><?= number_format($begbaltotaldebet, 2, ",", ".") ?></b></td> 

         <?php }
        ?> 
        <?php 
        if($begbaltotalcredit < 0.00) {
        ?> 
            <td align = "right"><b><?= "(". number_format(abs($begbaltotalcredit), 2, ",", ".") . ")"?></b></td> 
        <?php 
         } else {
        ?>
            <td align = "right"><b><?= number_format($begbaltotalcredit, 2, ",", ".") ?></b></td> 

         <?php }
        ?> 

        <?php 
        if($totaldebet < 0.00) {
        ?> 
            <td align = "right"><b><?= "(". number_format(abs($totaldebet), 2, ",", ".") . ")"?></b></td> 
        <?php 
         } else {
        ?>
            <td align = "right"><b><?= number_format($totaldebet, 2, ",", ".") ?></b></td> 

         <?php }
        ?> 
        <?php 
        if($totalcredit < 0.00) {
        ?> 
            <td align = "right"><b><?= "(". number_format(abs($totalcredit), 2, ",", ".") . ")"?></b></td> 
        <?php 
         } else {
        ?>
            <td align = "right"><b><?= number_format($totalcredit, 2, ",", ".") ?></b></td> 

         <?php }
        ?> 

        <?php 
        if($baltotaldebet < 0.00) {
        ?> 
            <td align = "right"><b><?= "(". number_format(abs($baltotaldebet), 2, ",", ".") . ")"?></b></td> 
        <?php 
         } else {
        ?>
            <td align = "right"><b><?= number_format($baltotaldebet, 2, ",", ".") ?></b></td> 

         <?php }
        ?> 
        <?php 
        if($baltotalcredit < 0.00) {
        ?> 
            <td align = "right"><b><?= "(". number_format(abs($baltotalcredit), 2, ",", ".") . ")"?></b></td> 
        <?php 
         } else {
        ?>
            <td align = "right"><b><?= number_format($baltotalcredit, 2, ",", ".") ?></b></td> 

         <?php }
        ?> 

    </tr>
</table>
<!-- <div style ="border-bottom: solid">"a"</div> -->
<div style ="color:#fff; border-top: solid; border-top-color:grey; padding: 0px 0;">"a"</div>
<table border = "0">
   
    
</table> 

