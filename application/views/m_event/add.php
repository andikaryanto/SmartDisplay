<div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item active">Master       </li>
    </ul>
  </div>
</div>
<section>
  <div class="container-fluid">
    <!-- Page Header-->
    <header> 
          <h1 class="h3 display"><?= lang('ui_master_event')?> </h1>
      </tr>
    </header>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <div class = "row">
              <div class="col-6">
                <h4><?= lang('ui_data')?></h4>
              </div>
              <div class="col-6 text-right">
                <!-- <a href="<?= base_url('mevent')?>"><i class = "fa fa-table"></i> Data</a> -->
              </div>
            </div>
          </div>
          <div class="card-body">                 
            <form method = "post" action = "<?= base_url('mevent/addsave');?>">
              <div class="form-group">
                <div class = "required">
                  <label><?= lang('ui_name')?></label>
                  <input id="named" type="text" placeholder="<?= lang('ui_event') ?>" class="form-control" name = "named" value="<?= $model->Name?>" required>
                </div>
              </div>
              <div class = "row">
                <div class = "col-sm-6"> 
                  <div class="form-group"> 
                    <div class = "required">
                      <label><?= lang('ui_datefrom')?></label>
                      <input id="activedate" type="text" class="form-control datepicker" autocomplete="off" name = "activedate" value="<?= $model->ActiveDate?>" required>
                    </div>
                  </div>
                </div>
                <div class = "col-sm-6">
                  <div class="form-group"> 
                    <div class = "required">
                      <label><?= lang('ui_dateto')?></label>
                      <input id="inactivedate" type="text" class="form-control datepicker" autocomplete="off" name = "inactivedate" value="<?= $model->InactiveDate?>" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class = "row">
                <div class = "col-sm-6"> 
                  <div class="form-group"> 
                    <div class = "required">
                      <label><?= lang('ui_timestart')?></label>
                      <input id="timestart" type="text" class="form-control timepicker" autocomplete="off" name = "timestart" value="<?= $model->TimeStart?>" required>
                    </div>
                  </div>
                </div>
                <div class = "col-sm-6">
                  <div class="form-group"> 
                    <div class = "required">
                      <label><?= lang('ui_timeend')?></label>
                      <input id="timeend" type="text" class="form-control timepicker" autocomplete="off" name = "timeend" value="<?= $model->TimeEnd?>" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">       
                <label><?= lang('ui_description')?></label>
                <textarea id="description" placeholder="<?= lang('ui_description') ?>" type="text" class="form-control" name = "description" ><?= $model->Description?></textarea>
              </div>
              <div class="form-group">       
                <input type="submit" value="<?= lang('ui_save')?>" class="btn btn-primary">
                <a href="<?= base_url('mevent')?>" value="<?= lang('ui_cancel')?>" class="btn btn-primary"><?= lang('ui_cancel')?></a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  $(document).ready(function() {    
    init();
  });

  function init(){
    
  }

</script>