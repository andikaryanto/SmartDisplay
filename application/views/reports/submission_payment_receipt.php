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
            <strong style="font-size: 20px;"><?= lang('ui_submissionpayment')?></strong>
        </td>
        <td align = "right" colspan="2" valign = "bottom">
            <strong style="font-size: 20px;"><?= lang('ui_receipt')?></strong>
        </td>
    </tr>
    <tr>
        <td align = "left" colspan="4">
            <?=lang('ui_towho'). "  :"?>
        </td>
        <td align = "left" colspan="10">
        <?= $submissionfrom ?>
        </td>
        <td align = "left" colspan="12">
           
        </td>
        
        <td align = "right" colspan="2">
            <?= lang('ui_receiptno').' : ' ?>
        </td>
        
        <td align = "right" colspan="2">
            <strong><?= $submissionpayment->NoPayment ?></strong>
        </td>
    </tr>
    <tr>
        <td align = "left" colspan="4">
        </td>
        <td align = "left" colspan="20">
            <?= $address?>
        </td>
        <td colspan="2">
           
        </td>
        
        <td align = "right" colspan="2" valign = "top">
            <?= lang('ui_paymentdate').' : ' ?>
        </td>
        
        <td align = "right" colspan="2" valign = "top">
            <?= get_formated_date($submissionpayment->PaymentDate,'d F Y') ?>
        </td>
        
    </tr>
</table>
<div style ="color: #fff">"a"</div>
<table  border = "0">
    <tr  style = "background-color:#99ff99;">
        <th height ="25">
            <?= lang('ui_month')?>
        </th>
        <th align = "left">
            <?= lang('ui_duedate')?>
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
    <?php foreach($submissionpayment->get_list_T_Submissionpaymentdetail() as $value)
    {
    ?>
    <tr>
        <td height ="25" align = "center"><?= $value->Month ?></td>
        <td align = "left"><?= get_formated_date($value->getDueDate(), 'd-M-Y')?></td>
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
    ?>
</table>
<!-- <div style ="border-bottom: solid">"a"</div> -->
<div style ="color:#fff; border-top: solid; border-top-color:grey; padding: 0px 0;">"a"</div>
<table border = "0">
    <tr>    
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
    </tr>
    <tr >
        <td align = "right" >
           <h3> <?=lang('ui_total'). "  :"?></h3>
        </td>
        <td align = "right" style ="border-bottom: solid; border-bottom-color:grey;">
            <h3><?= number_format($total, 2, ",", ".")?></h3>
        </td>
    </tr>
</table>

