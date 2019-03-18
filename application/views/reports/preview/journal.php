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
                                    foreach($models as $key => $model){
                                        // echo json_encode($model);
                                ?>
                                    <tr>
                                        <td class="px-0 bg-transparent"><b><?= $key ?></b></td>
                                        <td class="px-1 bg-transparent"></td>
                                        <td class="px-1 bg-transparent text-right"></td>
                                        <td class="px-1 bg-transparent text-right"></td>
                                    
                                    </tr>
                                <?php   
                                        foreach ($model as $keydetail => $detail){
                                ?>
                                    
                                <?php       
                                        $i = 0;
                                        foreach ($detail as $keycontent => $contentdetail){
                                            // echo json_encode($contentdetail);
                                ?>
                                <?php
                                            if($i == 0) {
                                                $i++;
                                ?>
                                    <tr>
                                        <td class="px-0 bg-transparent border-top-0"><b><?= get_formated_date($contentdetail['TranDate'], 'Y-M-d')?></b></td>
                                        <td class="px-1 bg-transparent border-top-0"><b><?= $keydetail ?></b></td>
                                        <td class="px-1 bg-transparent border-top-0 text-right"></td>
                                        <td class="px-1 bg-transparent border-top-0 text-right"></td>
                                    </tr>
                                <?php
                                            }
                                ?>
                                    <tr>
                                        <td class="px-0 bg-transparent border-top-0"></td>
                                        <td class="px-1 bg-transparent border-top-0"><?= $contentdetail['Description']?></td>
                                        <td class="px-1 bg-transparent border-top-0 text-right"><?= number_format($contentdetail['Debet'],2 ,",",".");?></td>
                                        <td class="px-1 bg-transparent border-top-0 text-right"><?= number_format($contentdetail['Credit'],2 ,",",".");?></td>
                                    
                                    </tr>
                                <?php
                                                
                                                $totaldebet += $contentdetail['Debet'];
                                                $totalcredit += $contentdetail['Credit'];
                                            }
                                        }
                                    }
                                    
                                ?>
                                    <tr>
                                        <th class="px-0 bg-transparent"></th>
                                        <th class="px-1 bg-transparent"><?= lang('ui_total')?></th>
                                        <th class="px-1 bg-transparent text-right"><?= number_format($totaldebet,2 ,",",".");?></th>
                                        <th class="px-1 bg-transparent text-right"><?= number_format($totalcredit,2 ,",",".");?></th>
                                    
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