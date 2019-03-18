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
            <strong style="font-size: 20px;"><?= lang('report_generalledger')?></strong>
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
    <?php $coa = $this->M_chartofaccounts->get($params['coaid'])?>
    <tr >
        <th height ="25">
           
        </th>
        <th align = "left" height ="25">
            
        </th>
        <th align = "right">
            
        </th>
        <th align = "right">
           
        </th>
        <th align = "right">
            <?= $coa->Code." ~ ".$coa->Name?>
        </th>
    </tr>
    <tr style = "background-color:#99ff99;">
        <th height ="25">
            <?= lang('ui_date')?>
        </th>
        <th align = "left" height ="25">
            <?= lang('ui_description')?>
        </th>
        <th align = "right">
            <?= lang('ui_debet')?>
        </th>
        <th align = "right">
            <?= lang('ui_credit')?>
        </th>
        <th align = "right">
            <?= lang('ui_balance')?>
        </th>
    </tr>
    <?php 
    
    foreach($models as $model) {
    ?>
    <tr>
        <td height ="25" align = "center"><?= get_formated_date($model->TranDate, 'd-M-Y') ?></td>
        <td align = "left"><?= $model->JournalNo." ~ " .$model->Description?></td>
        <?php 
        if($model->Debet < 0.00) {
        ?> 
            <td align = "right"><?= "( ". number_format(abs($model->Debet), 2, ",", ".") . " )"?></td> 
        <?php 
         } else {
        ?>
            <td align = "right"><?= number_format($model->Debet, 2, ",", ".") ?></td> 

         <?php }
        ?> 
        <td align = "right"><?= number_format($model->Credit, 2, ",", ".")?></td>
        <?php 
        if($model->Balance < 0.00) {
        ?> 
            <td align = "right"><?= "( ". number_format(abs($model->Balance), 2, ",", ".") . " )"?></td> 
        <?php 
         } else {
        ?>
            <td align = "right"><?= number_format($model->Balance, 2, ",", ".") ?></td> 

         <?php }
        ?> 
    
    </tr>
    <?php
        $totaldebet += $model->Debet;
        $totalcredit += $model->Credit;
        // $totalfinepayment += $value->FinePayment;
        // $totalratepayment += $value->RatePayment;
        // $total += $value->Amount;
    }
    ?>
    <tr>
        <td height ="25" align = "center"></td>
        <td align = "left"><b><?=lang('ui_subtotal'). "  :"?></b></td>
        <?php 
        if($totaldebet < 0.00) {
        ?> 
            <td align = "right"><b><?= "( ". number_format(abs($totaldebet), 2, ",", ".") . " )"?></b></td> 
        <?php 
         } else {
        ?>
            <td align = "right"><b><?= number_format($totaldebet, 2, ",", ".") ?></b></td> 

         <?php }
        ?> 
        <td align = "right"><b><?= number_format($totalcredit, 2, ",", ".")?></b></td>
        <td align = "right"></td>

    </tr>
    <tr>
        <td height ="25" align = "center"></td>
        <td align = "left"><b><?=lang('ui_total'). "  :"?></b></td>
        <td align = "right"><b></b></td>
        <td align = "right"><b></b></td>
        <?php 
        if($totaldebet - $totalcredit < 0.00) {
        ?> 
            <td align = "right"><b><?= "( ". number_format(abs($totaldebet - $totalcredit), 2, ",", ".") . " )"?></b></td> 
        <?php 
         } else {
        ?>
            <td align = "right"><b><?= number_format($totaldebet - $totalcredit, 2, ",", ".") ?></b></td> 

         <?php }
        ?> 
        
    </tr>
</table>
<!-- <div style ="border-bottom: solid">"a"</div> -->
<div style ="color:#fff; border-top: solid; border-top-color:grey; padding: 0px 0;">"a"</div>
<table border = "0">
   
    
</table> 

