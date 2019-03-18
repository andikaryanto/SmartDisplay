<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
            <form method = "post" action = "<?= base_url('reports/generalledger_from_preview')?>" target="_blank"> 
                    <header class="d-flex flex-column flex-sm-row justify-content-between align-items-center">
                    <h1 class="h3 display mb-2 mb-sm-0"> <?= lang('ui_preview'). " " . lang('ui_transaction')?></h1>
                    <p class="mb-0">
                        <input hidden name = "coaid" value = "<?= $params['coaid']?>">
                        <input hidden name = "datefrom" value = "<?= $params['datefrom']?>">
                        <input hidden name = "dateto" value = "<?= $params['dateto']?>">
                        <button type = "submit" class="btn btn-outline-secondary mb-2 mb-sm-0"><?= lang('ui_print')?></button>
                    </p>
                    </header>
                </form>
                <div class="card card-body p-5">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <h1 class="text-uppercase text-muted"><?= lang('ui_generalledger')?></h1>
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
                        <div class="col-12 col-md-12 text-right">
                            <?php $coa = $this->M_chartofaccounts->get($params['coaid'])?>
                            <h1 class="text-uppercase text-primary"><?= $coa->Code." ~ ".$coa->Name?></h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                        <!-- Table-->
                            <div class="table-responsive">
                                <table class="table my-4">
                                    <thead>
                                        <tr>
                                            <th class="px-0 bg-transparent border-top-0"><span class="h6"><?= lang('ui_date')?></span></th>
                                            <th class="px-0 bg-transparent border-top-0"><span class="h6"><?= lang('ui_description')?></span></th>
                                            <th class="px-0 bg-transparent border-top-0 text-right"><span class="h6"><?= lang('ui_debet')?></span></th>
                                            <th class="px-0 bg-transparent border-top-0 text-right"><span class="h6"><?= lang('ui_credit')?></span></th>
                                            <th class="px-0 bg-transparent border-top-0 text-right"><span class="h6"><?= lang('ui_balance')?></span></th>
                                        </tr>
                                    </thead>
                                <tbody>
                                <?php 
                                    
                                    $totaldebet=0.00;
                                    $totalcredit=0.00;
                                    foreach($models as $model) {
                                        
                                ?>

                                    <tr>
                                        <td class="px-0 bg-transparent border-top-0"><?= get_formated_date($model->TranDate, 'd-M-Y') ?></td>
                                        <td class="px-1 bg-transparent border-top-0"><?= $model->JournalNo ." ~ " .$model->Description?></td>
                                        <?php 
                                        if($model->Debet < 0.00) {
                                        ?>
                                        <td class="px-1 bg-transparent border-top-0 text-right"><?= "( ". number_format(abs($model->Debet), 2, ",", ".") . " )"?></td>
                                        <?php
                                        } else {
                                        ?>
                                        <td class="px-1 bg-transparent border-top-0 text-right"><?= number_format($model->Debet, 2, ",", ".")?></td>
                                            <?php
                                        }
                                        ?>
                                        <td class="px-1 bg-transparent border-top-0 text-right"><?= number_format($model->Credit, 2, ",", ".")?></td>

                                        <?php 
                                        if($model->Balance < 0.00) {
                                            ?>
                                        <td class="px-1 bg-transparent border-top-0 text-right"><?= "( ". number_format(abs($model->Balance), 2, ",", ".") . " )"?></td>
                                            <?php
                                        } else {
                                            ?>
                                        <td class="px-1 bg-transparent border-top-0 text-right"><?= number_format($model->Balance, 2, ",", ".")?></td>
                                            <?php
                                        }
                                        ?>
                                    
                                    </tr>
                                <?php

                                        $totaldebet += $model->Debet;
                                        $totalcredit += $model->Credit;
                                    }
                                    
                                ?>
                                    <tr>
                                        <th class="px-0 bg-transparent border-top-0"></th>
                                        <th class="px-1 bg-transparent border-top-0"><?= lang('ui_subtotal')?></th>
                                        <?php 
                                        if($totaldebet < 0.00) {
                                            ?>
                                        <td class="px-1 bg-transparent border-top-0 text-right"><?= "( ". number_format(abs($totaldebet), 2, ",", ".") . " )"?></td>
                                            <?php
                                        } else {
                                            ?>
                                        <td class="px-1 bg-transparent border-top-0 text-right"><?= number_format($totaldebet, 2, ",", ".")?></td>
                                            <?php
                                        }
                                        ?>
                                        <?php 
                                        if($totalcredit < 0.00) {
                                            ?>
                                        <td class="px-1 bg-transparent border-top-0 text-right"><?= "( ". number_format(abs($totalcredit), 2, ",", ".") . " )"?></td>
                                            <?php
                                        } else {
                                            ?>
                                        <td class="px-1 bg-transparent border-top-0 text-right"><?= number_format($totalcredit, 2, ",", ".")?></td>
                                            <?php
                                        }
                                        ?>
                                        <th class="px-1 bg-transparent border-top-0 text-right"></th>
                                    
                                    </tr>
                                    
                                    <tr>
                                        <th class="px-0 bg-transparent border-top-0"></th>
                                        <th class="px-1 bg-transparent border-top-0"><?= lang('ui_total')?></th>
                                        <th class="px-1 bg-transparent border-top-0 text-right"></th>
                                        <th class="px-1 bg-transparent border-top-0 text-right"></th>
                                        <?php 
                                        if($totaldebet - $totalcredit < 0.00) {
                                            ?>
                                        <th class="px-1 bg-transparent border-top-0 text-right"><?= "( ". number_format(abs($totaldebet - $totalcredit), 2, ",", ".") . " )"?></th>
                                            <?php
                                        } else {
                                            ?>
                                        <th class="px-1 bg-transparent border-top-0 text-right"><?= number_format($totaldebet - $totalcredit, 2, ",", ".")?></th>
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