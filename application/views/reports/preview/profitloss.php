<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
            <form method = "post" action = "<?= base_url('reports/profitloss_from_preview')?>" target="_blank"> 
                    <header class="d-flex flex-column flex-sm-row justify-content-between align-items-center">
                    <h1 class="h3 display mb-2 mb-sm-0"> <?= lang('ui_preview'). " " . lang('ui_profitloss')?></h1>
                    <p class="mb-0">
                        <input hidden name = "datefrom" value = "<?= $params['datefrom']?>">
                        <input hidden name = "dateto" value = "<?= $params['dateto']?>">
                        <button type = "submit" class="btn btn-outline-secondary mb-2 mb-sm-0"><?= lang('ui_print')?></button>
                    </p>
                    </header>
                </form>
                <div class="card card-body p-5">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <h1 class="text-uppercase text-muted"><?= lang('ui_profitloss')?></h1>
                            <h6 class="text-muted"><?= lang('ui_datefrom')." : ".$datefrom?></h6>
                            <h6 class="text-muted"><?= lang('ui_dateto')." : ".$dateto?></h6>
                        </div>
                        <!-- <div class="col-12 col-md-6 text-md-right">
                            <h6 class="text-uppercase text-muted">Invoiced to</h6>
                            <p class="text-muted mb-4"><strong class="text-body">Jack London</strong><br>                    Lonely Wolf<br>                    1150 Lost St.<br>                    Middle of Nowhere</p>
                            <h6 class="text-uppercase text-muted">Due date</h6>
                            <p class="mb-4">
                                <time datetime="2018-04-23">Feb 23, 2019</time>
                            </p>
                        </div> -->
                    </div>
                    <div class="row">
                        <div class="col-12">
                        <!-- Table-->
                            <div class="table-responsive">
                                <table class="table my-4">
                                    <thead>
                                        <tr>
                                            <th class="px-0 bg-transparent border-top-0"><span class="h6"></span></th>
                                            <th class="px-0 bg-transparent border-top-0"><span class="h6">Rp</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th class="px-0 bg-transparent border-top-1"><span class="h6"><?= lang('ui_sell')?></span></th>
                                            <th class="px-0 bg-transparent border-top-1 text-right"><span class="h6"></span></th>
                                        </tr>
                                        <?php 
                                        $totalincome = 0.00;
                                        foreach($models['income'] as $income) {
                                            $totalincome += $income->Amount;
                                        ?>
                                        <tr>
                                            <td class="px-5 bg-transparent border-top-0"><?= $income->Code."~".$income->Name?></td>
                                            <td class="px-0 bg-transparent border-top-0 text-right"><?= number_format(abs($income->Amount), 2, ",",".")?></td>
                                        </tr>
                                        <?php
                                        }?>
                                        <tr>
                                            <th class="px-0 bg-transparent border-top-0 text-right"><?= lang('ui_total')." ". lang('ui_sell')?></th>
                                            <th class="px-0 bg-transparent border-top-0 text-right"><?= number_format($totalincome, 2, ",",".")?></th>
                                        </tr>

                                        <tr>
                                            <th class="px-0 bg-transparent border-top-1"><span class="h6"><?= lang('ui_costofgoodsold')?></span></th>
                                            <th class="px-0 bg-transparent border-top-1 text-right"><span class="h6"></span></th>
                                        </tr>
                                        <?php 
                                        $totalcogs = 0.00;
                                        foreach($models['cogs'] as $cogs) {
                                            $totalcogs += $income->Amount;
                                        ?>
                                        <tr>
                                            <td class="px-5 bg-transparent border-top-0"><?= $cogs->Code."~".$cogs->Name?></td>
                                            <td class="px-0 bg-transparent border-top-0 text-right"><?= number_format(abs($cogs->Amount), 2, ",",".")?></td>
                                        </tr>
                                        <?php
                                        }?>
                                        <tr>
                                            <th class="px-0 bg-transparent border-top-0 text-right"><?= lang('ui_costofgoodsold')?></th>
                                            <th class="px-0 bg-transparent border-top-0 text-right"><?= number_format($totalcogs, 2, ",",".")?></th>
                                        </tr>
                                        <?php $totalgrossprofit = $totalincome - $totalcogs;?>
                                        <tr>
                                            <th class="px-0 bg-transparent border-top-1"><?= lang('ui_grossprofit')?></th>
                                            <th class="px-0 bg-transparent border-top-1 text-right"><?= number_format($totalgrossprofit, 2, ",",".")?></th>
                                        </tr>

                                        <tr>
                                            <th class="px-0 bg-transparent border-top-1"><span class="h6"><?= lang('ui_operatingexpense')?></span></th>
                                            <th class="px-0 bg-transparent border-top-1 text-right"><span class="h6"></span></th>
                                        </tr>
                                        <?php 
                                        $totalcost = 0.00;
                                        foreach($models['cost'] as $cost) {
                                            $totalcost += $cost->Amount;
                                        ?>
                                        <tr>
                                            <td class="px-5 bg-transparent border-top-0"><?= $cost->Code."~".$cost->Name?></td>
                                            <td class="px-0 bg-transparent border-top-0 text-right"><?= number_format(abs($cost->Amount), 2, ",",".")?></td>
                                        </tr>
                                        <?php
                                        }?>
                                        <tr>
                                            <th class="px-0 bg-transparent border-top-0 text-right"><?= lang('ui_operatingexpense')?></th>
                                            <th class="px-0 bg-transparent border-top-0 text-right"><?= number_format($totalcost, 2, ",",".")?></th>
                                        </tr>
                                        
                                        <?php $totalopearatingprofit = $totalgrossprofit - $totalcost;?>
                                        <tr>
                                            <th class="px-0 bg-transparent border-top-1"><?= lang('ui_operatingprofit')?></th>
                                            <th class="px-0 bg-transparent border-top-1 text-right"><?= number_format($totalopearatingprofit, 2, ",",".")?></th>
                                        </tr>

                                        <tr>
                                            <th class="px-0 bg-transparent border-top-1"><span class="h6"><?= lang('ui_otherincome')?></span></th>
                                            <th class="px-0 bg-transparent border-top-1 text-right"><span class="h6"></span></th>
                                        </tr>
                                        <?php 
                                        $totalnonoperational = 0.00;
                                        foreach($models['nonoperational'] as $nonoperational) {
                                            $totalnonoperational += $nonoperational->Amount;
                                        ?>
                                        <tr>
                                            <td class="px-5 bg-transparent border-top-0"><?= $nonoperational->Code."~".$nonoperational->Name?></td>
                                            <td class="px-0 bg-transparent border-top-0 text-right"><?= number_format(abs($nonoperational->Amount), 2, ",",".")?></td>
                                        </tr>
                                        <?php
                                        }?>
                                        <tr>
                                            <th class="px-0 bg-transparent border-top-0 text-right"><?= lang('ui_otherincome')?></th>
                                            <th class="px-0 bg-transparent border-top-0 text-right"><?= number_format($totalnonoperational, 2, ",",".")?></th>
                                        </tr>

                                        <?php $netprofit = $totalopearatingprofit - $totalnonoperational;?>
                                        <tr>
                                            <th class="px-0 bg-transparent border-top-1"><span class="h6"><?= lang('ui_netprofit')?></span></th>
                                            <th class="px-0 bg-transparent border-top-1 text-right"><span class="h6"><?= number_format($netprofit, 2, ",",".")?></span></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>