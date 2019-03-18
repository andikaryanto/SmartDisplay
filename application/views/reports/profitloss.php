<?php
    include APPPATH.'views/template/reportheader.php';

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
            <strong style="font-size: 20px;"><?= lang('ui_profitloss')?></strong>
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
        <th align = "left" height ="25">
            <?= lang('ui_description')?>
        </th>
        <th align = "left">
            Rp
        </th>
    </tr>
    <tr>
        <th align = "left" height ="25"><?= lang('ui_sell')?></th>
        <th></th>
    </tr>
    <?php 
    $totalincome = 0.00;
    foreach($models['income'] as $income) {
        $totalincome += $income->Amount;
    ?>
    <tr>
        <td align = "left" height ="25"><?= $income->Code."~".$income->Name?></td>
        <td align = "right"><?= number_format(abs($income->Amount), 2, ",",".")?></td>
    </tr>
    <?php
    }?>
    <tr>
        <th><?= lang('ui_total')." ". lang('ui_sell')?></th>
        <th align = "right"><?= number_format($totalincome, 2, ",",".")?></th>
    </tr>

    <tr>
        <th align = "left"><?= lang('ui_costofgoodsold')?></th>
        <th></th>
    </tr>
    <?php 
    $totalcogs = 0.00;
    foreach($models['cogs'] as $cogs) {
        $totalcogs += $income->Amount;
    ?>
    <tr>
        <td align = "left" height ="25"><?= $cogs->Code."~".$cogs->Name?></td>
        <td align = "right"><?= number_format(abs($cogs->Amount), 2, ",",".")?></td>
    </tr>
    <?php
    }?>
    <tr>
        <th height ="25"><?= lang('ui_costofgoodsold')?></th>
        <th align = "right"><?= number_format($totalcogs, 2, ",",".")?></th>
    </tr>
    <?php $totalgrossprofit = $totalincome - $totalcogs;?>
    <tr>
        <th align = "left" height ="25"><?= lang('ui_grossprofit')?></th>
        <th align = "right"><?= number_format($totalgrossprofit, 2, ",",".")?></th>
    </tr>

    <tr>
        <th align = "left" height ="25"><?= lang('ui_operatingexpense')?></th>
        <th></th>
    </tr>
    <?php 
    $totalcost = 0.00;
    foreach($models['cost'] as $cost) {
        $totalcost += $cost->Amount;
    ?>
    <tr>
        <td align = "left" height ="25"><?= $cost->Code."~".$cost->Name?></td>
        <td align = "right"><?= number_format(abs($cost->Amount), 2, ",",".")?></td>
    </tr>
    <?php
    }?>
    <tr>
        <th height ="25"><?= lang('ui_operatingexpense')?></th>
        <th align = "right"><?= number_format($totalcost, 2, ",",".")?></th>
    </tr>
    
    <?php $totalopearatingprofit = $totalgrossprofit - $totalcost;?>
    <tr>
        <th align = "left" height ="25"><?= lang('ui_operatingprofit')?></th>
        <th align = "right"><?= number_format($totalopearatingprofit, 2, ",",".")?></th>
    </tr>

    <tr>
        <th align = "left" height ="25"><?= lang('ui_otherincome')?></th>
        <th></th>
    </tr>
    <?php 
    $totalnonoperational = 0.00;
    foreach($models['nonoperational'] as $nonoperational) {
        $totalnonoperational += $nonoperational->Amount;
    ?>
    <tr>
        <td align = "left" height ="25"><?= $nonoperational->Code."~".$nonoperational->Name?></td>
        <td align = "right"><?= number_format(abs($nonoperational->Amount), 2, ",",".")?></td>
    </tr>
    <?php
    }?>
    <tr>
        <th><?= lang('ui_otherincome')?></th>
        <th align = "right" height ="25"><?= number_format($totalnonoperational, 2, ",",".")?></th>
    </tr>

    <?php $netprofit = $totalopearatingprofit - $totalnonoperational;?>
    <tr>
        <th align = "left" height ="25"><?= lang('ui_netprofit')?></th>
        <th align = "right"><?= number_format($netprofit, 2, ",",".")?></th>
    </tr>
</table>
<!-- <div style ="border-bottom: solid">"a"</div> -->

