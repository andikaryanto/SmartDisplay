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
    foreach($models as $key => $model){
    ?>
     <tr>
        <td height ="25" align = "left"><b><?= $key ?></b></td>
     </tr>
    <?php
        foreach ($model as $keydetail => $detail){
    ?>
         
    <?php 
            $i = 0;
            foreach ($detail as $keycontent => $contentdetail){
 
    ?>
    <?php
                if($i == 0) {
                    $i++;
    ?>
        <tr>
            <td height ="25" align = "center"><b><?= get_formated_date($contentdetail['TranDate'], 'd-M-Y') ?></b></td>
            <td align = "left"><b><?=  $keydetail?></b></td>
            <td align = "right"></td>
            <td align = "right"></td>
         </tr>
    <?php
                }
                                ?>
        <tr>
            <td height ="25" align = "center"></td>
            <td align = "left"><?= $contentdetail['Description']?></td>
            <td align = "right"><?= number_format($contentdetail['Debet'],2 ,",",".");?></td>
            <td align = "right"><?=number_format($contentdetail['Credit'],2 ,",",".");?></td>
        
        </tr>
    <?php

                $totaldebet += $contentdetail['Debet'];
                $totalcredit += $contentdetail['Credit'];
        // $totalfinepayment += $value->FinePayment;
        // $totalratepayment += $value->RatePayment;
        // $total += $value->Amount;
            }
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

