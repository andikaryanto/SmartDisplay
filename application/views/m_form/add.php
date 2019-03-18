<div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item active"><?= lang('ui_linkaccount')?>       </li>
    </ul>
  </div>
</div>
<section>
  <div class="container-fluid">
    <!-- Page Header-->
    <header> 
          <!-- <h1 class="h3 display"><?= lang('ui_mainsetup')?> </h1> -->
      
    </header>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <div class = "row">
              <div class="col-sm-6">
                <h4><?= lang('ui_linkaccount')?></h4>
              </div>
              <div class="col-sm-6 text-right">
                <!-- <a href="<?= base_url('maccount')?>"><i class = "fa fa-table"></i> Data</a> -->
              </div>
            </div>
          </div>
          <div class="card-body"> 
            <div id="accordion" role="tablist">
              <div class="card-collapse">
                <div class="card-header" role="tab" id="headingOne">
                  <h5 class="mb-0">
                    <a data-toggle="collapse" href="#journal" aria-expanded="false" aria-controls="journal" class="collapsed">
                      <?= lang('ui_transaction')?>
                    </a>
                  </h5>
                </div>
                <div id="journal" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" style="">
                  <div class="card-body">
                    <form method = "post" id="formTransJournal" action = "<?= base_url('m_form/savejournal')?>">
                      <div class = "row">
                        <label class="col-sm-2 col-form-label"><?= lang('ui_numberformat')?></label>
                        <div class = "col-md-10">
                          <div class="form-group bmd-form-group">
                            <input id="formatnumber" type="text"  class="form-control transnumberformat" name = "formatnumber" value = "<?= $journalmodel[0]->StringValue?>">
                            <span class="bmd-help text-primary"><?= lang('info_membernumberformat')?></span>
                          </div>
                        </div>
                      </div>
                      <div class = "row">
                        <div class="col-md-12">
                          <h2 class="display h4 text-primary"><?= lang('ui_income')?></h2>
                        </div>
                      </div>
                      <div class = "row">
                        <label class="col-sm-2 col-form-label"><?= lang('ui_numberformat')?></label>
                        <div class = "col-md-10">
                          <div class="form-group bmd-form-group">
                            <input id="incomeformatnumber" type="text"  class="form-control transnumberformat" name = "incomeformatnumber" value = "<?= $journalmodel[23]->StringValue?>">
                            <span class="bmd-help text-primary"><?= lang('info_membernumberformat')?></span>
                          </div>
                        </div>
                      </div>
                      
                      <div class = "row">
                        <div class="col-md-12">
                          <h2 class="display h4 text-primary"><?= lang('ui_expense')?></h2>
                        </div>
                      </div>
                      <div class = "row">
                        <label class="col-sm-2 col-form-label"><?= lang('ui_numberformat')?></label>
                        <div class = "col-md-10">
                          <div class="form-group bmd-form-group">
                            <input id="expenseformatnumber" type="text"  class="form-control transnumberformat" name = "expenseformatnumber" value = "<?= $journalmodel[24]->StringValue?>">
                            <span class="bmd-help text-primary"><?= lang('info_membernumberformat')?></span>
                          </div>
                        </div>
                      </div>

                      
                      
                      <div class = "row">
                        <div class="col-md-12">
                          <h2 class="display h4 text-primary"><?= lang('ui_others')?></h2>
                        </div>
                      </div>
                      <div class = "row">
                        <label class="col-sm-2 col-form-label"><?= lang('ui_numberformat')?></label>
                        <div class = "col-md-10">
                          <div class="form-group bmd-form-group">
                            <input id="adjustmentformatnumber" type="text"  class="form-control transnumberformat" name = "adjustmentformatnumber" value = "<?= $journalmodel[25]->StringValue?>">
                            <span class="bmd-help text-primary"><?= lang('info_membernumberformat')?></span>
                          </div>
                        </div>
                      </div>


                      <div class = "row">
                        <div class="col-md-12">
                          <h2 class="display h4 text-primary"><?= lang('ui_income')?></h2>
                        </div>
                      </div>
                      <div class = "form-group row">
                        <label class="col-sm-2 col-form-label"><?= lang('ui_save')." ".lang('ui_to')?></label>
                        <div class = "col-md-10">
                          <div class="input-group has-success">
                            <input hidden id = "incomedebetaccountid" name ="incomedebetaccountid" value = "<?= $journalmodel[1]->IntValue?>">
                            <input id = "incomedebetaccountname" type="text" class="form-control custom-readonly" name="incomedebetaccountname" value="<?= $journalmodel[1]->StringValue?>" readonly>
                            <div class="input-group-append">
                              <button id="btnAccountModal" onclick="test('incomedebetaccountid', 'incomedebetaccountname');" data-toggle="modal" type="button" class="btn btn-primary" data-target="#modalAccount"><i class="fa fa-search"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class = "form-group row">
                        <label class="col-sm-2 col-form-label"><?= lang('ui_received')." ".lang('ui_from')?></label>
                        <div class = "col-md-10">
                          <div class="input-group has-success">
                            <input hidden id = "incomecreditaccountid" name ="incomecreditaccountid" value = "<?= $journalmodel[2]->IntValue?>">
                            <input id = "incomecreditaccountname" type="text" class="form-control custom-readonly" name ="incomecreditaccountname"  value="<?= $journalmodel[2]->StringValue?>" readonly>
                            <div class="input-group-append">
                              <button id="btnAccountModal" onclick="test('incomecreditaccountid', 'incomecreditaccountname');" data-toggle="modal" type="button" class="btn btn-primary" data-target="#modalAccount"><i class="fa fa-search"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class = "row">
                        <div class="col-md-12">
                          <h2 class="display h4 text-primary"><?= lang('ui_expense')?></h2>
                        </div>
                      </div>
                      <div class = "form-group row">
                        <label class="col-sm-2 col-form-label"><?= lang('ui_for')?></label>
                        <div class = "col-md-10">
                          <div class="input-group has-success">
                            <input hidden id = "expensedebetaccountid" name ="expensedebetaccountid" value = "<?= $journalmodel[3]->IntValue?>">
                            <input id = "expensedebetaccountname" type="text" class="form-control custom-readonly" name ="expensedebetaccountname" value="<?= $journalmodel[3]->StringValue?>" readonly>
                            <div class="input-group-append">
                              <button id="btnAccountModal" onclick="test('expensedebetaccountid', 'expensedebetaccountname');" data-toggle="modal" type="button" class="btn btn-primary" data-target="#modalAccount"><i class="fa fa-search"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class = "form-group row">
                        <label class="col-sm-2 col-form-label"><?= lang('ui_taken')." ".lang('ui_from')?></label>
                        <div class = "col-md-10">
                          <div class="input-group has-success">
                            <input hidden id = "expensecreditaccountid" name ="expensecreditaccountid" value = "<?= $journalmodel[4]->IntValue?>">
                            <input id = "expensecreditaccountname" type="text" class="form-control custom-readonly" name ="expensecreditaccountname" value="<?= $journalmodel[4]->StringValue?>" readonly>
                            <div class="input-group-append">
                              <button id="btnAccountModal" onclick="test('expensecreditaccountid', 'expensecreditaccountname');" data-toggle="modal" type="button" class="btn btn-primary" data-target="#modalAccount"><i class="fa fa-search"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class = "row">
                        <div class="col-md-12">
                          <h2 class="display h4 text-primary"><?= lang('ui_debt')?></h2>
                        </div>
                      </div>
                      <div class = "form-group row">
                        <label class="col-sm-2 col-form-label"><?= lang('ui_debt')." ".lang('ui_from')?></label>
                        <div class = "col-md-10">
                          <div class="input-group has-success">
                            <input hidden id = "debtdebetaccountid" name ="debtdebetaccountid" value = "<?= $journalmodel[5]->IntValue?>">
                            <input id = "debtdebetaccountname" type="text" class="form-control custom-readonly" name ="debtdebetaccountname" value="<?= $journalmodel[5]->StringValue?>" readonly>
                            <div class="input-group-append">
                              <button id="btnAccountModal" onclick="test('debtdebetaccountid', 'debtdebetaccountname');" data-toggle="modal" type="button" class="btn btn-primary" data-target="#modalAccount"><i class="fa fa-search"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class = "form-group row">
                        <label class="col-sm-2 col-form-label"><?= lang('ui_save')." ".lang('ui_to')?></label>
                        <div class = "col-md-10">
                          <div class="input-group has-success">
                            <input hidden id = "debtcreditaccountid" name ="debtcreditaccountid" value = "<?= $journalmodel[6]->IntValue?>">
                            <input id = "debtcreditaccountname" type="text" class="form-control custom-readonly" name ="debtcreditaccountname" value="<?= $journalmodel[6]->StringValue?>" readonly>
                            <div class="input-group-append">
                              <button id="btnAccountModal" onclick="test('debtcreditaccountid', 'debtcreditaccountname');" data-toggle="modal" type="button" class="btn btn-primary" data-target="#modalAccount"><i class="fa fa-search"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <div class = "row">
                        <div class="col-md-12">
                          <h2 class="display h4 text-primary"><?= lang('ui_paydebt')?></h2>
                        </div>
                      </div>
                      <div class = "form-group row">
                        <label class="col-sm-2 col-form-label"><?= lang('ui_save')." ".lang('ui_to')?></label>
                        <div class = "col-md-10">
                          <div class="input-group has-success">
                            <input hidden id = "paydebtdebetaccountid" name ="paydebtdebetaccountid" value = "<?= $journalmodel[7]->IntValue?>">
                            <input id = "paydebtdebetaccountname" type="text" class="form-control custom-readonly" name ="paydebtdebetaccountname" value="<?= $journalmodel[7]->StringValue?>" readonly>
                            <div class="input-group-append">
                              <button id="btnAccountModal" onclick="test('paydebtdebetaccountid', 'paydebtdebetaccountname');" data-toggle="modal" type="button" class="btn btn-primary" data-target="#modalAccount"><i class="fa fa-search"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class = "form-group row">
                        <label class="col-sm-2 col-form-label"><?= lang('ui_from')?></label>
                        <div class = "col-md-10">
                          <div class="input-group has-success">
                            <input hidden id = "paydebtcreditaccountid" name ="paydebtcreditaccountid" value = "<?= $journalmodel[8]->IntValue?>">
                            <input id = "paydebtcreditaccountname" type="text" class="form-control custom-readonly" name ="paydebtcreditaccountname" value="<?= $journalmodel[8]->StringValue?>" readonly>
                            <div class="input-group-append">
                              <button id="btnAccountModal" onclick="test('paydebtcreditaccountid', 'paydebtcreditaccountname');" data-toggle="modal" type="button" class="btn btn-primary" data-target="#modalAccount"><i class="fa fa-search"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <div class = "row">
                        <div class="col-md-12">
                          <h2 class="display h4 text-primary"><?= lang('ui_receivable')?></h2>
                        </div>
                      </div>
                      <div class = "form-group row">
                        <label class="col-sm-2 col-form-label"><?= lang('ui_save')." ".lang('ui_to')?></label>
                        <div class = "col-md-10">
                          <div class="input-group has-success">
                            <input hidden id = "receivabledebetaccountid" name ="receivabledebetaccountid" value = "<?= $journalmodel[9]->IntValue?>">
                            <input id = "receivabledebetaccountname" type="text" class="form-control custom-readonly" name ="receivabledebetaccountname" value="<?= $journalmodel[9]->StringValue?>" readonly>
                            <div class="input-group-append">
                              <button id="btnAccountModal" onclick="test('receivabledebetaccountid', 'receivabledebetaccountname');" data-toggle="modal" type="button" class="btn btn-primary" data-target="#modalAccount"><i class="fa fa-search"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class = "form-group row">
                        <label class="col-sm-2 col-form-label"><?= lang('ui_from')?></label>
                        <div class = "col-md-10">
                          <div class="input-group has-success">
                            <input hidden id = "receivablecreditaccountid" name ="receivablecreditaccountid" value = "<?= $journalmodel[10]->IntValue?>">
                            <input id = "receivablecreditaccountname" type="text" class="form-control custom-readonly" name ="receivablecreditaccountname" value="<?= $journalmodel[10]->StringValue?>" readonly>
                            <div class="input-group-append">
                              <button id="btnAccountModal" onclick="test('receivablecreditaccountid', 'receivablecreditaccountname');" data-toggle="modal" type="button" class="btn btn-primary" data-target="#modalAccount"><i class="fa fa-search"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <div class = "row">
                        <div class="col-md-12">
                          <h2 class="display h4 text-primary"><?= lang('ui_paidreceivable')?></h2>
                        </div>
                      </div>
                      <div class = "form-group row">
                        <label class="col-sm-2 col-form-label"><?= lang('ui_save')." ".lang('ui_to')?></label>
                        <div class = "col-md-10">
                          <div class="input-group has-success">
                            <input hidden id = "paidreceivabledebetaccountid" name ="paidreceivabledebetaccountid" value = "<?= $journalmodel[11]->IntValue?>">
                            <input id = "paidreceivabledebetaccountname" type="text" class="form-control custom-readonly" name ="paidreceivabledebetaccountname" value="<?= $journalmodel[11]->StringValue?>" readonly>
                            <div class="input-group-append">
                              <button id="btnAccountModal" onclick="test('paidreceivabledebetaccountid', 'paidreceivabledebetaccountname');" data-toggle="modal" type="button" class="btn btn-primary" data-target="#modalAccount"><i class="fa fa-search"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class = "form-group row">
                        <label class="col-sm-2 col-form-label"><?= lang('ui_from')?></label>
                        <div class = "col-md-10">
                          <div class="input-group has-success">
                            <input hidden id = "paidreceivablecreditaccountid" name ="paidreceivablecreditaccountid" value = "<?= $journalmodel[12]->IntValue?>">
                            <input id = "paidreceivablecreditaccountname" type="text" class="form-control custom-readonly" name ="paidreceivablecreditaccountname" value="<?= $journalmodel[12]->StringValue?>" readonly>
                            <div class="input-group-append">
                              <button id="btnAccountModal" onclick="test('paidreceivablecreditaccountid', 'paidreceivablecreditaccountname');" data-toggle="modal" type="button" class="btn btn-primary" data-target="#modalAccount"><i class="fa fa-search"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <div class = "row">
                        <div class="col-md-12">
                          <h2 class="display h4 text-primary"><?= lang('ui_capitalincrease')?></h2>
                        </div>
                      </div>
                      <div class = "form-group row">
                        <label class="col-sm-2 col-form-label"><?= lang('ui_taken')." ".lang('ui_from')?></label>
                        <div class = "col-md-10">
                          <div class="input-group has-success">
                            <input hidden id = "capitalincreasedebetaccountid" name ="capitalincreasedebetaccountid" value = "<?= $journalmodel[13]->IntValue?>">
                            <input id = "capitalincreasedebetaccountname" type="text" class="form-control custom-readonly" name ="capitalincreasedebetaccountname" value="<?= $journalmodel[13]->StringValue?>" readonly>
                            <div class="input-group-append">
                              <button id="btnAccountModal" onclick="test('capitalincreasedebetaccountid', 'capitalincreasedebetaccountname');" data-toggle="modal" type="button" class="btn btn-primary" data-target="#modalAccount"><i class="fa fa-search"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class = "form-group row">
                        <label class="col-sm-2 col-form-label"><?= lang('ui_save')." ".lang('ui_to')?></label>
                        <div class = "col-md-10">
                          <div class="input-group has-success">
                            <input hidden id = "capitalincreasecreditaccountid" name ="capitalincreasecreditaccountid" value = "<?= $journalmodel[14]->IntValue?>">
                            <input id = "capitalincreasecreditaccountname" type="text" class="form-control custom-readonly" name ="capitalincreasecreditaccountname" value="<?= $journalmodel[14]->StringValue?>" readonly>
                            <div class="input-group-append">
                              <button id="btnAccountModal" onclick="test('capitalincreasecreditaccountid', 'capitalincreasecreditaccountname');" data-toggle="modal" type="button" class="btn btn-primary" data-target="#modalAccount"><i class="fa fa-search"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <div class = "row">
                        <div class="col-md-12">
                          <h2 class="display h4 text-primary"><?= lang('ui_capitalwithdrawal')?></h2>
                        </div>
                      </div>
                      <div class = "form-group row">
                        <label class="col-sm-2 col-form-label"><?= lang('ui_taken')." ".lang('ui_from')?></label>
                        <div class = "col-md-10">
                          <div class="input-group has-success">
                            <input hidden id = "capitalwithdrawaldebetaccountid" name ="capitalwithdrawaldebetaccountid" value = "<?= $journalmodel[15]->IntValue?>">
                            <input id = "capitalwithdrawaldebetaccountname" type="text" class="form-control custom-readonly" name ="capitalwithdrawaldebetaccountname" value="<?= $journalmodel[15]->StringValue?>" readonly>
                            <div class="input-group-append">
                              <button id="btnAccountModal" onclick="test('capitalwithdrawaldebetaccountid', 'capitalwithdrawaldebetaccountname');" data-toggle="modal" type="button" class="btn btn-primary" data-target="#modalAccount"><i class="fa fa-search"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class = "form-group row">
                        <label class="col-sm-2 col-form-label"><?= lang('ui_save')." ".lang('ui_from')?></label>
                        <div class = "col-md-10">
                          <div class="input-group has-success">
                            <input hidden id = "capitalwithdrawalcreditaccountid" name ="capitalwithdrawalcreditaccountid" value = "<?= $journalmodel[16]->IntValue?>">
                            <input id = "capitalwithdrawalcreditaccountname" type="text" class="form-control custom-readonly" name ="capitalwithdrawalcreditaccountname" value="<?= $journalmodel[16]->StringValue?>" readonly>
                            <div class="input-group-append">
                              <button id="btnAccountModal" onclick="test('capitalwithdrawalcreditaccountid', 'capitalwithdrawalcreditaccountname');" data-toggle="modal" type="button" class="btn btn-primary" data-target="#modalAccount"><i class="fa fa-search"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <div class = "row">
                        <div class="col-md-12">
                          <h2 class="display h4 text-primary"><?= lang('ui_assetsale')?></h2>
                        </div>
                      </div>
                      <div class = "form-group row">
                        <label class="col-sm-2 col-form-label"><?= lang('ui_to')?></label>
                        <div class = "col-md-10">
                          <div class="input-group has-success">
                            <input hidden id = "assetsaledebetaccountid" name ="assetsaledebetaccountid" value = "<?= $journalmodel[17]->IntValue?>">
                            <input id = "assetsaledebetaccountname" type="text" class="form-control custom-readonly" name ="assetsaledebetaccountname" value="<?= $journalmodel[17]->StringValue?>" readonly>
                            <div class="input-group-append">
                              <button id="btnAccountModal" onclick="test('assetsaledebetaccountid', 'assetsaledebetaccountname');" data-toggle="modal" type="button" class="btn btn-primary" data-target="#modalAccount"><i class="fa fa-search"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class = "form-group row">
                        <label class="col-sm-2 col-form-label"><?= lang('ui_from')?></label>
                        <div class = "col-md-10">
                          <div class="input-group has-success">
                            <input hidden id = "assetsalecreditaccountid" name ="assetsalecreditaccountid" value = "<?= $journalmodel[18]->IntValue?>">
                            <input id = "assetsalecreditaccountname" type="text" class="form-control custom-readonly" name ="assetsalecreditaccountname" value="<?= $journalmodel[18]->StringValue?>" readonly>
                            <div class="input-group-append">
                              <button id="btnAccountModal" onclick="test('assetsalecreditaccountid', 'assetsalecreditaccountname');" data-toggle="modal" type="button" class="btn btn-primary" data-target="#modalAccount"><i class="fa fa-search"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <div class = "row">
                        <div class="col-md-12">
                          <h2 class="display h4 text-primary"><?= lang('ui_assetpurchase')?></h2>
                        </div>
                      </div>
                      <div class = "form-group row">
                        <label class="col-sm-2 col-form-label"><?= lang('ui_to')?></label>
                        <div class = "col-md-10">
                          <div class="input-group has-success">
                            <input hidden id = "assetpurchasedebetaccountid" name ="assetpurchasedebetaccountid" value = "<?= $journalmodel[19]->IntValue?>">
                            <input id = "assetpurchasedebetaccountname" type="text" class="form-control custom-readonly" name ="assetpurchasedebetaccountname" value="<?= $journalmodel[19]->StringValue?>" readonly>
                            <div class="input-group-append">
                              <button id="btnAccountModal" onclick="test('assetpurchasedebetaccountid', 'assetpurchasedebetaccountname');" data-toggle="modal" type="button" class="btn btn-primary" data-target="#modalAccount"><i class="fa fa-search"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class = "form-group row">
                        <label class="col-sm-2 col-form-label"><?= lang('ui_from')?></label>
                        <div class = "col-md-10">
                          <div class="input-group has-success">
                            <input hidden id = "assetpurchasecreditaccountid" name ="assetpurchasecreditaccountid" value = "<?= $journalmodel[20]->IntValue?>">
                            <input id = "assetpurchasecreditaccountname" type="text" class="form-control custom-readonly" name ="assetpurchasecreditaccountname" value="<?= $journalmodel[20]->StringValue?>" readonly>
                            <div class="input-group-append">
                              <button id="btnAccountModal" onclick="test('assetpurchasecreditaccountid', 'assetpurchasecreditaccountname');" data-toggle="modal" type="button" class="btn btn-primary" data-target="#modalAccount"><i class="fa fa-search"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <div class = "row">
                        <div class="col-md-12">
                          <h2 class="display h4 text-primary"><?= lang('ui_adjustment')?></h2>
                        </div>
                      </div>
                      <div class = "form-group row">
                        <label class="col-sm-2 col-form-label"><?= lang('ui_from')?></label>
                        <div class = "col-md-10">
                          <div class="input-group has-success">
                            <input hidden id = "assetadjustmentdebetaccountid" name ="assetadjustmentdebetaccountid" value = "<?= $journalmodel[21]->IntValue?>">
                            <input id = "assetadjustmentdebetaccountname" type="text" class="form-control custom-readonly" name ="assetadjustmentdebetaccountname" value="<?= $journalmodel[21]->StringValue?>" readonly>
                            <div class="input-group-append">
                              <button id="btnAccountModal" onclick="test('assetadjustmentdebetaccountid', 'assetadjustmentdebetaccountname');" data-toggle="modal" type="button" class="btn btn-primary" data-target="#modalAccount"><i class="fa fa-search"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class = "form-group row">
                        <label class="col-sm-2 col-form-label"><?= lang('ui_to')?></label>
                        <div class = "col-md-10">
                          <div class="input-group has-success">
                            <input hidden id = "assetadjustmentcreditaccountid" name ="assetadjustmentcreditaccountid" value = "<?= $journalmodel[22]->IntValue?>">
                            <input id = "assetadjustmentcreditaccountname" type="text" class="form-control custom-readonly" name ="assetadjustmentcreditaccountname" value="<?= $journalmodel[22]->StringValue?>" readonly>
                            <div class="input-group-append">
                              <button id="btnAccountModal" onclick="test('assetadjustmentcreditaccountid', 'assetadjustmentcreditaccountname');" data-toggle="modal" type="button" class="btn btn-primary" data-target="#modalAccount"><i class="fa fa-search"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class = "row">
                        <div class = "col-md-10">
                          <div class="form-group">       
                            <input type="submit" value="<?= lang('ui_save')?>" class="btn btn-primary">
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  var url = "<?= base_url('M_chartofaccount/getAllAccount')?>";
  var tableCoa;
  var inputid;
  var inputname;
  $(document).ready(function() {    
    init();
    loadModal();
  });

  function test(id, name){
    inputid = id;
    inputname = name;

    if(inputid == "incomedebetaccountid"){
      url = "<?= base_url('M_chartofaccount/getCashBankAccount')?>"
      reloadDtTable(tableCoa, url);

    } else if (inputid == "incomecreditaccountid") {
      url = "<?= base_url('M_chartofaccount/getIncomeAccount')?>"
      reloadDtTable(tableCoa, url);

    } else if (inputid == "expensedebetaccountid") {
      url = "<?= base_url('M_chartofaccount/getCostAccount')?>"
      reloadDtTable(tableCoa, url);

    } else if (inputid == "expensecreditaccountid") {
      url = "<?= base_url('M_chartofaccount/getCashBankAccount')?>"
      reloadDtTable(tableCoa, url);

    } else if (inputid == "debtdebetaccountid") {
      url = "<?= base_url('M_chartofaccount/getCashBankAccount')?>"
      reloadDtTable(tableCoa, url);

    } else if (inputid == "debtcreditaccountid") {
      url = "<?= base_url('M_chartofaccount/getPayableAccount')?>"
      reloadDtTable(tableCoa, url);

    } else if (inputid == "paydebtdebetaccountid") {
      url = "<?= base_url('M_chartofaccount/getPayableAccount')?>"
      reloadDtTable(tableCoa, url);

    } else if (inputid == "paydebtcreditaccountid") {
      url = "<?= base_url('M_chartofaccount/getCashBankAccount')?>"
      reloadDtTable(tableCoa, url);

    } else if (inputid == "receivabledebetaccountid") {
      url = "<?= base_url('M_chartofaccount/getReceivableAccount')?>"
      reloadDtTable(tableCoa, url);

    } else if (inputid == "receivablecreditaccountid") {
      url = "<?= base_url('M_chartofaccount/getIncomeAccount')?>"
      reloadDtTable(tableCoa, url);

    } else if (inputid == "paidreceivabledebetaccountid") {
      url = "<?= base_url('M_chartofaccount/getCashBankAccount')?>"
      reloadDtTable(tableCoa, url);

    } else if (inputid == "paidreceivablecreditaccountid") {
      url = "<?= base_url('M_chartofaccount/getReceivableAccount')?>"
      reloadDtTable(tableCoa, url);

    } else if (inputid == "capitalincreasedebetaccountid") {
      url = "<?= base_url('M_chartofaccount/getIncreaseAccount')?>"
      reloadDtTable(tableCoa, url);

    } else if (inputid == "capitalincreasecreditaccountid") {
      url = "<?= base_url('M_chartofaccount/getCapitalAccount')?>"
      reloadDtTable(tableCoa, url);

    } else if (inputid == "capitalwithdrawaldebetaccountid") {
      url = "<?= base_url('M_chartofaccount/getCapitalAccount')?>"
      reloadDtTable(tableCoa, url);

    } else if (inputid == "capitalwithdrawalcreditaccountid") {
      url = "<?= base_url('M_chartofaccount/getIncreaseAccount')?>"
      reloadDtTable(tableCoa, url);
    
    } else if (inputid == "assetsaledebetaccountid") {
      url = "<?= base_url('M_chartofaccount/getCashBankAccount')?>"
      reloadDtTable(tableCoa, url);

    } else if (inputid == "assetsalecreditaccountid") {
      url = "<?= base_url('M_chartofaccount/getAssetAccount')?>"
      reloadDtTable(tableCoa, url);
    
    } else if (inputid == "assetpurchasedebetaccountid") {
      url = "<?= base_url('M_chartofaccount/getAssetAccount')?>"
      reloadDtTable(tableCoa, url);

    } else if (inputid == "assetpurchasecreditaccountid") {
      url = "<?= base_url('M_chartofaccount/getCashBankAccount')?>"
      reloadDtTable(tableCoa, url);

    } else {
      url = "<?= base_url('M_chartofaccount/getAllAccount')?>"
      reloadDtTable(tableCoa, url);
    }
  }
  function loadModal(){
    tableCoa = $('#tableModalAccount').DataTable({
      "pagingType": "full_numbers",
      "lengthMenu": [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
      responsive: true,
      language: {
        search: "_INPUT_",
        "search": "<?= lang('ui_search')?>"+" : ",
      },
      "columnDefs": [
        {
            "targets": [ 0 ],
            "visible": false,
            "searchable": false
        },
      ],
      ajax: {
        url : url,
        dataSrc : 'data'
      },
      columns: [
        { 
          "data": "Id"
        },
        { 
          "data": "Code"
        },
        { "data": "Name" }
      ],

    });

    tableCoa.on( 'click', 'tr', function () {
        $tr = $(this).closest('tr');

        var data = tableCoa.row($tr).data();
        // var id = $tr.attr('id');
        // console.log(data);

        $("#"+inputid).val(data['Id']);
        $("#"+inputname).val(data['Code']+"~"+data['Name']);
        $('#modalAccount').modal('hide');
      } 
    );
  }
     // Edit record
  
  function reloadDtTable(table, newurl){
    table.clear().draw();
    table.ajax.url(newurl).load();
  }

  function init(){
    
  }
</script>