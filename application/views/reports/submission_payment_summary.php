<?php
    include APPPATH.'views/template/reportheader.php';

    $subtotalpayment=0;
    $totalfinepayment=0;
    $totalratepayment=0;
    $total=0;
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
        <td  height ="70" colspan="28" valign = "bottom">
            <strong style="font-size: 20px;"><?= lang('report_submission_payment_summary')?></strong>
        </td>
        <td align = "right" colspan="2">
            <!-- <strong style="font-size: 20px;"><?= lang('ui_receipt')?></strong> -->
        </td>
    </tr>
    <tr>
        <td style = "width:20%">
            <div class = "table-title"><?= lang('ui_datefrom')?></strong>
        </td>
        <td align = "left" colspan="10">
            <div class = "table-title"><?= ": ".$datefrom ?></strong>
        </td>
    </tr>
    
    <tr>
        <td style = "width:20%">
            <div class = "table-title"><?= lang('ui_dateto')?></strong>
        </td>
        <td align = "left" colspan="10">
            <div class = "table-title"><?= ": ".$dateto ?></strong>
        </td>
    </tr>
    
</table>
<div style ="color: #fff">"a"</div>
<table  border = "0">
    <tr style = "background-color:#99ff99;">
        <th align = "left" height ="25">
            <?= lang('ui_nosubmission')?>
        </th>
        <th align = "left">
            <?= lang('ui_submissiondate')?>
        </th>
        <th align = "left">
            <?= lang('ui_submitter')?>
        </th>
        <th align = "left">
            <?= lang('ui_loan')?>
        </th>
        <th align = "right">
            <?= lang('ui_plafon')?>
        </th>
        <th align = "right">
            <?= lang('ui_span')?>
        </th cv>
        <th align = "right">
            <?= lang('ui_outstanding')?>
        </th>
    </tr>
    <?php foreach($submission as $value){
       
    ?>
    <tr>
        <td height ="25" align = "left"><?= $value->NoSubmission ?></td>
        <td align = "left"><?= get_formated_date($value->ApplyDate, 'd-M-Y')?></td>
        <td align = "left"><?= $value->getSubmitterName()?></td>
        <td align = "left"><?= $value->get_M_Loan()->Name?></td>
        <td align = "right"><?= number_format($value->Plafon, 2, ",", ".")?></td>
        <td align = "right"><?= $value->Span?></td>
        <td align = "right"><?= number_format($value->getOutstanding(), 2, ",", ".")?></td>
    
    </tr>
    <?php

    }
    ?>
</table>
<!-- <div style ="border-bottom: solid">"a"</div> -->
<div style ="color:#fff; border-top: solid; border-top-color:grey; padding: 0px 0;">"a"</div>

