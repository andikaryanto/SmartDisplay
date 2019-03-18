<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <form method = "post" action = "<?= base_url('reports/trialbalance_from_preview')?>" target="_blank"> 
                    <header class="d-flex flex-column flex-sm-row justify-content-between align-items-center">
                    <h1 class="h3 display mb-2 mb-sm-0"> <?= lang('ui_preview'). " " . lang('ui_transaction')?></h1>
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
                            <h1 class="text-uppercase text-muted"><?= lang('ui_trialbalance')?></h1>
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
                                            <th class="px-0 bg-transparent border-top-0" ><span class="h6"><?= lang('ui_description')?></span></th>
                                            <th class="px-0 bg-transparent border-top-0"><span class="h6"></span></th>
                                            <th class="px-0 bg-transparent border-top-0 text-right"><span class="h6"><?= lang('ui_beginningbalance')?></span></th>
                                            <th class="px-0 bg-transparent border-top-0"><span class="h6"></span></th>
                                            <th class="px-0 bg-transparent border-top-0 text-right"><span class="h6"><?= lang('ui_transaction')?></span></th>
                                            <th class="px-0 bg-transparent border-top-0"><span class="h6"></span></th>
                                            <th class="px-0 bg-transparent border-top-0 text-right"><span class="h6"><?= lang('ui_balance')?></span></th>
                                        </tr>
                                        <tr>
                                            <th class="px-0 bg-transparent border-top-0"><span class="h6"></span></th>
                                            <th class="px-0 bg-transparent border-top-0 text-right"><span class="h6"><?= lang('ui_debet')?></span></th>
                                            <th class="px-0 bg-transparent border-top-0 text-right"><span class="h6"><?= lang('ui_credit')?></span></th>
                                            <th class="px-0 bg-transparent border-top-0 text-right"><span class="h6"><?= lang('ui_debet')?></span></th>
                                            <th class="px-0 bg-transparent border-top-0 text-right"><span class="h6"><?= lang('ui_credit')?></span></th>
                                            <th class="px-0 bg-transparent border-top-0 text-right"><span class="h6"><?= lang('ui_debet')?></span></th>
                                            <th class="px-0 bg-transparent border-top-0 text-right"><span class="h6"><?= lang('ui_credit')?></span></th>
                                        </tr>
                                    </thead>
                                <tbody>
                                <?php 
                                    
                                    $begbaltotaldebet=0.00;
                                    $begbaltotalcredit=0.00;
                                    $totaldebet=0.00;
                                    $totalcredit=0.00;
                                    $baltotaldebet=0.00;
                                    $baltotalcredit=0.00;
                                    foreach($models as $model) {
                                        
                                ?>

                                    <tr>
                                        <td class="px-1 bg-transparent border-top-0"><?=$model->Code."~".$model->Name?></td>
                                        
                                        <?php 
                                        if($model->BegBalanceDebet < 0.00) {
                                            ?>
                                        <td class="px-1 bg-transparent border-top-0 text-right"><?= "(". number_format(abs($model->BegBalanceDebet), 2, ",", ".") . ")"?></td>
                                            <?php
                                        } else {
                                            ?>
                                        <td class="px-1 bg-transparent border-top-0 text-right"><?= number_format($model->BegBalanceDebet, 2, ",", ".")?></td>
                                            <?php
                                        }
                                        ?>
                                        <?php 
                                        if($model->BegBalanceCredit < 0.00) {
                                            ?>
                                        <td class="px-1 bg-transparent border-top-0 text-right"><?= "(". number_format(abs($model->BegBalanceCredit), 2, ",", ".") . ")"?></td>
                                            <?php
                                        } else {
                                            ?>
                                        <td class="px-1 bg-transparent border-top-0 text-right"><?= number_format($model->BegBalanceCredit, 2, ",", ".")?></td>
                                            <?php
                                        }
                                        ?>
                                        <?php 
                                        if($model->Debet < 0.00) {
                                        ?>
                                        <td class="px-1 bg-transparent border-top-0 text-right"><?= "(". number_format(abs($model->Debet), 2, ",", ".") . ")"?></td>
                                        <?php
                                        } else {
                                        ?>
                                        <td class="px-1 bg-transparent border-top-0 text-right"><?= number_format($model->Debet, 2, ",", ".")?></td>
                                            <?php
                                        }
                                        ?>
                                        <td class="px-1 bg-transparent border-top-0 text-right"><?= number_format($model->Credit, 2, ",", ".")?></td>

                                        <?php 
                                        if($model->BalanceDebet < 0.00) {
                                            ?>
                                        <td class="px-1 bg-transparent border-top-0 text-right"><?= "(". number_format(abs($model->BalanceDebet), 2, ",", ".") . ")"?></td>
                                            <?php
                                        } else {
                                            ?>
                                        <td class="px-1 bg-transparent border-top-0 text-right"><?= number_format($model->BalanceDebet, 2, ",", ".")?></td>
                                            <?php
                                        }
                                        ?>
                                        <?php 
                                        if($model->BalanceCredit < 0.00) {
                                            ?>
                                        <td class="px-1 bg-transparent border-top-0 text-right"><?= "(". number_format(abs($model->BalanceCredit), 2, ",", ".") . ")"?></td>
                                            <?php
                                        } else {
                                            ?>
                                        <td class="px-1 bg-transparent border-top-0 text-right"><?= number_format($model->BalanceCredit, 2, ",", ".")?></td>
                                            <?php
                                        }
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
                                        <th class="px-1 bg-transparent border-top-0"><?= lang('ui_subtotal')?></th>
                                        <?php 
                                        if($begbaltotaldebet < 0.00) {
                                            ?>
                                        <td class="px-1 bg-transparent border-top-0 text-right"><b><?= "(". number_format(abs($begbaltotaldebet), 2, ",", ".") . ")"?></b></td>
                                            <?php
                                        } else {
                                            ?>
                                        <td class="px-1 bg-transparent border-top-0 text-right"><b><?= number_format($begbaltotaldebet, 2, ",", ".")?></b></td>
                                            <?php
                                        }
                                        ?>
                                        <?php 
                                        if($begbaltotalcredit < 0.00) {
                                            ?>
                                        <td class="px-1 bg-transparent border-top-0 text-right"><b><?= "(". number_format(abs($begbaltotalcredit), 2, ",", ".") . ")"?></b></td>
                                            <?php
                                        } else {
                                            ?>
                                        <td class="px-1 bg-transparent border-top-0 text-right"><b><?= number_format($begbaltotalcredit, 2, ",", ".")?></b></td>
                                            <?php
                                        }
                                        ?>

                                        <?php 
                                        if($totaldebet < 0.00) {
                                            ?>
                                        <td class="px-1 bg-transparent border-top-0 text-right"><b><?= "(". number_format(abs($totaldebet), 2, ",", ".") . ")"?></b></td>
                                            <?php
                                        } else {
                                            ?>
                                        <td class="px-1 bg-transparent border-top-0 text-right"><b><?= number_format($totaldebet, 2, ",", ".")?></b></td>
                                            <?php
                                        }
                                        ?>
                                        <?php 
                                        if($totalcredit < 0.00) {
                                            ?>
                                        <td class="px-1 bg-transparent border-top-0 text-right"><b><?= "(". number_format(abs($totalcredit), 2, ",", ".") . ")"?></b></td>
                                            <?php
                                        } else {
                                            ?>
                                        <td class="px-1 bg-transparent border-top-0 text-right"><b><?= number_format($totalcredit, 2, ",", ".")?></b></td>
                                            <?php
                                        }
                                        ?>

                                        <?php 
                                        if($baltotaldebet < 0.00) {
                                            ?>
                                        <td class="px-1 bg-transparent border-top-0 text-right"><b><?= "(". number_format(abs($baltotaldebet), 2, ",", ".") . ")"?></b></td>
                                            <?php
                                        } else {
                                            ?>
                                        <td class="px-1 bg-transparent border-top-0 text-right"><b><?= number_format($baltotaldebet, 2, ",", ".")?></b></td>
                                            <?php
                                        }
                                        ?>
                                        <?php 
                                        if($baltotalcredit < 0.00) {
                                            ?>
                                        <td class="px-1 bg-transparent border-top-0 text-right"><b><?= "(". number_format(abs($baltotalcredit), 2, ",", ".") . ")"?></b></td>
                                            <?php
                                        } else {
                                            ?>
                                        <td class="px-1 bg-transparent border-top-0 text-right"><b><?= number_format($baltotalcredit, 2, ",", ".")?></b></td>
                                            <?php
                                        }
                                        ?>

                                    
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