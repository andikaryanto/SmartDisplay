<div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item active">Master</li>
    </ul>
  </div>
</div>
<section>
  <div class="container-fluid">
    <!-- Page Header-->
    <header> 
          <h1 class="h3 display"><?= lang('ui_company')?> </h1>
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
                <!-- <a href="<?= base_url('mCoa/add')?>"><i class = "fa fa-plus"></i> Tambah</a> -->
              </div>
            </div>
          </div>
          <div class="card-body">                
            <form method = "post" action = "<?= base_url('mcompany/addsave');?>" enctype= "multipart/form-data">
              <input hidden id = "companyid" name = "companyid" value = "<?= $model->Id?>">
              <div class="form-group">
                <label><?= lang('ui_name')?></label>
                <input id="named" type="text"  class="form-control" name = "named" value="<?= $model->CompanyName?>" required>
              </div>
              <!-- <div class = "row">
                <div class="col-sm-6">
                  <div class="form-group">       
                    <label><?= lang('ui_province')?></label>
                    <select id ="province" class="selectpicker form-control" name = 'province'>
                    </select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">       
                    <label><?= lang('ui_city')?></label>
                    <select id ="city" class="selectpicker form-control" name = 'city'>
                    </select>
                  </div>
                </div>
              </div> -->
              <div class="form-group">       
                <label><?= lang('ui_address')?></label>
                <textarea id="address" type="text" class="form-control" name = "address" ><?= $model->Address?></textarea>
              </div>
              <div class="form-group">
                <label><?= lang('ui_postcode')?></label>
                <input id="postcode" type="text"  class="form-control" name = "postcode" value="<?= $model->PostCode?>">
              </div>
              <div class = "row">
                <div class="col-sm-4">
                  <div class="form-group">       
                    <label><?= lang('ui_email')?></label>
                    <input id="email" type="email" class="form-control" name = "email" value = "<?= $model->Email?>" required>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">       
                    <label><?= lang('ui_telephone')?></label>
                    <input id="phone" type="text" class="form-control" name = "phone" value = "<?= $model->Phone?>" required>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">       
                    <label><?= lang('ui_fax')?></label>
                    <input id="fax" type="text" class="form-control" name = "fax" value = "<?= $model->Fax?>">
                  </div>
                </div>
              </div>
              <div class = "row">
                <div class="col-sm-6">
                  <div class="form-group">       
                    <label><?= lang('ui_period')?></label>
                    <input id="period" type="text" class="form-control yearperiod" name = "period" value = "<?= $model->Period?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="file"><?= lang('ui_picture')?></label>
                    <input accept = "image/jpg, image/jpeg, image/png" id="file" type="file" class="form-control-file" name = "file" required>
                  </div>
                </div>
              </div>
              <div class="form-group">       
                <input type="submit" value="<?= lang('ui_save')?>" class="btn btn-primary">
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</section>
               <!-- modal -->
<div id="modalChartOfAccounts" tabindex="-1" role="dialog" aria-labelledby="parentModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="parentModalLabel" class="modal-title"><?= lang('ui_parent')?></h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="card-body">
        <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar
                                  -->
        </div>
        <div class="material-datatables">
          <div id = "datatables_wrapper" class = "dataTables_wrapper dt-bootstrap4">
            <!-- <div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="datatables_length"><label>Show <select name="datatables_length" aria-controls="datatables" class="custom-select custom-select-sm form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="-1">All</option></select> entries</label></div></div><div class="col-sm-12 col-md-6"><div id="datatables_filter" class="dataTables_filter"><label><span class="bmd-form-group bmd-form-group-sm"><input type="search" class="form-control form-control-sm" placeholder="Search records" aria-controls="datatables"></span></label></div></div></div> -->
            <div class="row">
              <div class="col-sm-12">
                <div class="table-responsive">
                  <table data-page-length="-1" id = "tablemodalChartOfAccounts" class="table table-striped table-no-bordered table-hover dataTable dtr-inline collapsed" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                    <thead class=" text-primary">
                        <th><?=  lang('ui_code')?></th>
                        <th><?=  lang('ui_name')?></th>
                    </thead>
                    <tfoot class=" text-primary">
                      <tr role = "row">
                        <th><?=  lang('ui_code')?></th>
                        <th><?=  lang('ui_name')?></th>
                      </tr>
                    </tfoot>
                    <tbody>
                    <?php
                      //print_r($modeldetail);
                        $params = array(
                          'where' => array(
                            'Level' => 3
                          )
                        );
                        foreach ($this->M_chartofaccounts->get_list(null, null, $params) as $value)
                        {
                          
                      ?>
                          <tr class = "rowdetail" role = "row" id = "<?= $value->Id?>">
                            <td><?= $value->Code?></td>
                            <td><?= $value->Name?></td>
                          </tr>
                      <?php
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {    
    initcompany();
    loadModal();
  });  

  function loadModal(){
    var table = $('#tablemodalChartOfAccounts').DataTable({
      "pagingType": "full_numbers",
      "lengthMenu": [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
      responsive: true,
      language: {
      search: "_INPUT_",
      "search": "<?= lang('ui_search')?>"+" : ",
      }
    });

     // Edit record
     table.on( 'click', '.rowdetail', function () {
        $tr = $(this).closest('tr');

        var data = table.row($tr).data();
        var id = $tr.attr('id');

        $("#chartofaccountid").val(id);
        $("#chartofaccountname").val(data[0] +" "+data[1]);
        $('#modalChartOfAccounts').modal('hide');
     } );
  }

  function initcompany(){
    // $('.selectpicker').selectpicker({
    //   style : 'btn-primary'
    // }); 
    
  } 

</script>