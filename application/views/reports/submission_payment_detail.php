<?php
    include APPPATH.'views/template/reportheader.php';

    // $subtotalpayment=0;
    // $totalfinepayment=0;
    // $totalratepayment=0;
    // $total=0;
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
            <strong style="font-size: 20px;"><?= lang('report_submission_payment_detail')?></strong>
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
<?php foreach($submissions as $submission) {
    $subtotalpayment=0;
    $totalfinepayment=0;
    $totalratepayment=0;
    $total=0;
?>
<div style ="color: #fff">"a"</div>
<div class = "table-title"><?= "No. ".$submission->NoSubmission." ~ ".get_formated_date($submission->ApplyDate, 'd-M-Y')." ~ ".$submission->getSubmitterName()?></div>
<table  border = "0">
    <tr style = "background-color:#99ff99;">
        <th height ="25">
            <?= lang('ui_month')?>
        </th>
        <th align = "left" height ="25">
            <?= lang('ui_receiptno')?>
        </th>
        <th align = "left">s
            <?= lang('ui_duedate')?>
        </th>
        <th align = "left">
            <?= lang('ui_paymentdate')?>
        </th>
        <th align = "right">
            <?= lang('ui_installmentpayment')?>
        </th>
        <th align = "right">
            <?= lang('ui_ratepayment')?>
        </th>
        <th align = "right">
            <?= lang('ui_finepayment')?>
        </th cv>
        <th align = "right">
            <?= lang('ui_amountpayment')?>
        </th>
    </tr>
    <?php foreach($submission->get_list_T_Submissiondetail() as $detail){
        if($detail->isPaid()){
            $value = $detail->get_list_T_Submissionpaymentdetail()[0];
    ?>
    <tr>
        <td height ="25" align = "center"><?= $value->Month ?></td>
        <td align = "left"><?= $value->get_T_Submissionpayment()->NoPayment?></td>
        <td align = "left"><?= get_formated_date($value->getDueDate(), 'd-M-Y')?></td>
        <td align = "left"><?= get_formated_date($value->get_T_Submissionpayment()->PaymentDate, 'd-M-Y')?></td>
        <td align = "right"><?= number_format($value->Payment, 2, ",", ".")?></td>
        <td align = "right"><?= number_format($value->RatePayment, 2, ",", ".")?></td>
        <td align = "right"><?= number_format($value->FinePayment, 2, ",", ".")?></td>
        <td align = "right"><?= number_format($value->Amount, 2, ",", ".")?></td>
    
    </tr>
    <?php

        $subtotalpayment += $value->Payment;
        $totalfinepayment += $value->FinePayment;
        $totalratepayment += $value->RatePayment;
        $total += $value->Amount;
        }
    }
    ?>
</table>
<!-- <div style ="border-bottom: solid">"a"</div> -->
<div style ="color:#fff; border-top: solid; border-top-color:grey; padding: 0px 0;">"a"</div>
<table border = "0">
   <!--  <tr>    
        <td align = "right" style = "width:85%">
            <?= lang('ui_subtotal'). "  :"?>
        </td>
        <td align = "right" >
            <?= number_format($subtotalpayment, 2, ",", ".")?>
        </td>
    </tr>
    <tr>
        <td align = "right" >
            <?=lang('ui_rate'). "  :"?>
        </td>
        <td align = "right">
            <?= number_format($totalratepayment, 2, ",", ".")?>
        </td>
    </tr>
    <tr>
        <td align = "right" >
            <?=lang('ui_fine'). "  :"?>
        </td>
        <td align = "right">
            <?= number_format($totalfinepayment, 2, ",", ".")?>
        </td>
    </tr>-->
    <tr >
        <td align = "right" style = "width:80%">
           <h3> <?=lang('ui_total'). "  :"?></h3>
        </td>
        <td align = "right" style ="border-bottom: solid; border-bottom-color:grey;">
            <h3><?= number_format($total, 2, ",", ".")?></h3>
        </td>
    </tr>
</table> 
<?php }?>

