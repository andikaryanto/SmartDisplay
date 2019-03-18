<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <form method = "post" action = "<?= base_url('reports/journal_from_preview')?>" target="_blank"> 
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
                            <h1 class="text-uppercase text-muted"><?= lang('ui_journal')?></h1>
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
                                            <th class="px-0 bg-transparent border-top-0"><span class="h6"><?= lang('ui_date')?></span></th>
                                            <th class="px-0 bg-transparent border-top-0"><span class="h6"><?= lang('ui_description')?></span></th>
                                            <th class="px-0 bg-transparent border-top-0 text-right"><span class="h6"><?= lang('ui_debet')?></span></th>
                                            <th class="px-0 bg-transparent border-top-0 text-right"><span class="h6"><?= lang('ui_credit')?></span></th>
                                        </tr>
                                    </thead>
                                <tbody>
                                <?php 
                                    
                                    $totaldebet=0.00;
                                    $totalcredit=0.00;
                                    $trandate ="";
                                    $newtrandate = "";
                                    $debetmonth = 0.00;
                                    $creditmonth = 0.00;


                                    foreach($models as $model) {
                                        $noref = "";
                                        $trandate = get_formated_date($model->TranDate, 'F');
                                        if(!empty($model->Refno))
                                            $noref = " ( Ref. ".$model->Refno." )";
                                ?>
                                <?php 
                                        if($newtrandate != $trandate) { 
                                            $newtrandate = $trandate;
                                ?>
                                    <tr>
                                        <td class = "px-0"><b></b></td>
                                        <td class=" text-right"><b><?= lang('ui_subtotal')?></b></td>
                                        <td class="text-right"><b><?= number_format($debetmonth, 2, ",",".");?></b></td>
                                        <td class="text-right"><b><?= number_format($creditmonth, 2, ",",".");?></b></td>
                                    </tr>
                                    <tr>
                                        <td class = "px-0"><b><?=$newtrandate?></b></td>
                                        <td class=" text-right"></td>
                                        <td class="text-right"></td>
                                        <td class="text-right"></td>
                                    </tr>
                                <?php 
                                
                                            $debetmonth = 0.00;
                                            $creditmonth = 0.00;
                                        } else {
                                            $debetmonth += $balancedetail->Debet;
                                            $creditmonth += $balancedetail->Credit;
                                        }
                                ?>
                                    <tr>
                                        <td class = "px-0"></td>
                                        <td class = "px-1 "><b><?= "No. ".$model->JournalNo." ~ ".$model->Description.$noref?></b></td>
                                        <td class=" text-right"></td>
                                        <td class="text-right"></td>
                                    </tr>
                                <?php 
                                    foreach($model[$model] as $detail){
                                ?>
                                    <tr>
                                        <td class="px-0 bg-transparent border-top-0"><?= get_formated_date($model->TranDate, 'd-M-Y') ?></td>
                                        <td class="px-1 bg-transparent border-top-0"><?= $detail->get_M_Chartofaccount()->Code."~".$detail->get_M_Chartofaccount()->Name?></td>
                                        <td class="px-1 bg-transparent border-top-0 text-right"><?= number_format($detail->Debet, 2, ",", ".")?></td>
                                        <td class="px-1 bg-transparent border-top-0 text-right"><?= number_format($detail->Credit, 2, ",", ".")?></td>
                                    
                                    </tr>
                                    <?php

                                        $totaldebet += $detail->Debet;
                                        $totalcredit += $detail->Credit;
                                        // $totalfinepayment += $value->FinePayment;
                                        // $totalratepayment += $value->RatePayment;
                                        // $total += $value->Amount;
                                    }
                                }
                                ?>
                                    <tr>
                                        <th class="px-0 bg-transparent border-top-0"></th>
                                        <th class="px-1 bg-transparent border-top-0"><?= lang('ui_total')?></th>
                                        <th class="px-1 bg-transparent border-top-0 text-right"><?= number_format($totaldebet, 2, ",", ".")?></th>
                                        <th class="px-1 bg-transparent border-top-0 text-right"><?= number_format($totalcredit, 2, ",", ".")?></th>
                                        <th class="px-1 bg-transparent border-top-0 text-right"></th>
                                    
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