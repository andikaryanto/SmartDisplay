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
          <h1 class="h3 display"><?= lang('ui_master_tickersetting')?> </h1>
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
                <a href="<?= base_url('mtickersetting')?>"><i class = "fa fa-table"></i> Data</a>
              </div>
            </div>
          </div>
          <div class="card-body">                
            <form method = "post" action = "<?= base_url('mtickersetting/editsave');?>">
            
            <input hidden name ="idtickersetting" id="idtickersetting" value="<?= $model->Id?>">
            <div class = "row">
                <div class = "col-sm-12">
                  <div class="form-group">
                    <div class = "required">
                      <label><?= lang('ui_name')?></label>
                      <input id="named" type="text" placeholder="<?= lang('ui_tickersetting') ?>" class="form-control" name = "named" value="<?= $model->Name?>" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class = "row">
                <div class = "col-sm-12">
                  <div class="form-group">
                    <div class = "required">
                      <label><?= lang('ui_speed')?></label>
                      <input id="speed" type="number" placeholder="<?= lang('ui_speed') ?>" class="form-control" name = "speed" value="<?= $model->Speed?>" required>
                      <span class = "text-primary text-right"><?= lang('info_in_second')?></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class = "row">
                <div class = "col-sm-6">
                  <div class="form-group">
                    <div class = "required">
                      <label><?= lang('ui_backgroundcolor')?></label>
                      <input id="backgroundcolor" type="color" placeholder="<?= lang('ui_backgroundcolor') ?>" class="form-control" name = "backgroundcolor" value="<?= $model->BackGroundColor?>">
                    </div>
                  </div>
                </div>
                <div class = "col-sm-6">
                  <div class="form-group">
                    <div class = "required">
                      <label><?= lang('ui_fontcolor')?></label>
                      <input id="fontcolor" type="color" placeholder="<?= lang('ui_fontcolor') ?>" class="form-control" name = "fontcolor" value="<?= $model->FontColor?>">
                    </div>
                  </div>
                </div>
              </div>
              <div class = "row">
                <div class = "col-sm-6">
                  <div class="form-group">
                    <div class = "required">
                      <label><?= lang('ui_height')?></label>
                      <input id="height" type="number" placeholder="<?= lang('ui_heightr') ?>" class="form-control" name = "height" value="<?= $model->Height?>">
                      <span class = "text-primary text-right"><?= lang('info_in_percent')?></span>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group"> 
                    <div class = "required"> 
                      <label for="file"><?= lang('ui_multimedia')?></label>
                      <input accept = "image/jpg, image/jpeg, image/png" id="file" type="file" class="form-control-file" name = "file">
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">       
                <input type="submit" value="<?= lang('ui_save')?>" class="btn btn-primary">
                <a href="<?= base_url('mtickersetting')?>" value="<?= lang('ui_cancel')?>" class="btn btn-primary"><?= lang('ui_cancel')?></a>
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