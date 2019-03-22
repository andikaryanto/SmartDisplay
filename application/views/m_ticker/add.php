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
          <h1 class="h3 display"><?= lang('ui_master_ticker')?> </h1>
      </tr>
    </header>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <div class = "row">
              <div class="col-6">
                <h4><?= lang('ui_add_data')?></h4>
              </div>
              <div class="col-6 text-right">
                <a href="<?= base_url('mticker')?>"><i class = "fa fa-table"></i> Data</a>
              </div>
            </div>
          </div>
          <div class="card-body">                 
            <form method = "post" action = "<?= base_url('mticker/addsave');?>" enctype= "multipart/form-data">
              <input hidden id = "eventid" name = "eventid" value ="<?= $model->M_Event_Id?>">
              <div class="form-group">
                <div class = "required">
                  <label><?= lang('ui_name')?></label>
                  <input id="named" type="text" placeholder="<?= lang('ui_name') ?>" class="form-control" name = "named" value="<?= $model->Name?>" required>
                </div>
              </div>
              <div class="form-group">   
                <div class = "required">    
                  <label><?= lang('ui_description')?></label>
                  <textarea id="description" placeholder="<?= lang('ui_description') ?>" type="text" class="form-control" name = "description" ><?= $model->Description?></textarea>
                </div>
              </div>
              <div class="row" >
                <div class="col-md-6">
                  <div class="form-group">   
                    <div class = "required">       
                      <label><?= lang('ui_assigntype')?></label>
                      <select id ="assigntype" class="selectpicker form-control" name = 'assigntype'>
                      <?php foreach($this->M_enums->get_data_by_id(3) as $itemstatus) { ?>
                        <option value ="<?= $itemstatus->Value?>"><?= lang($itemstatus->Resource)?></option>
                      <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class = "required">
                      <label><?= lang('ui_even')?></label>
                      <div class="input-group has-success">
                        
                        <input id = "evenname" type="text" class="form-control custom-readonly"  value="<?= $model->get_M_Event()->Name?>" readonly>
                        <div class="input-group-append">
                          <button id="btnEvenModal" data-toggle="modal" type="button" class="btn btn-primary" data-target="#modalEven"><i class="fa fa-search"></i></button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">       
                <input type="submit" value="<?= lang('ui_save')?>" class="btn btn-primary">
                <a href="<?= base_url('mticker')?>" value="<?= lang('ui_cancel')?>" class="btn btn-primary"><?= lang('ui_cancel')?></a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- modal -->
<div id="modalEven" tabindex="-1" role="dialog" aria-labelledby="evenModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="evenModalLabel" class="modal-title"><?=  lang('ui_even')?></h5>
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
                  <table data-page-length="5" id = "tableModalEven" class="table table-striped table-no-bordered table-hover dataTable dtr-inline collapsed" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                    <thead class=" text-primary">
                        <th><?=  lang('ui_even')?></th>
                        <th><?=  lang('ui_datefrom')?></th>
                        <th><?=  lang('ui_dateto')?></th>
                        <th><?=  lang('ui_timestart')?></th>
                        <th><?=  lang('ui_timeend')?></th>
                        <!-- <th><?=  lang('ui_description')?></th> -->
                    </thead>
                    <tfoot class=" text-primary">
                      <tr role = "row">
                        <!-- <th># </th> -->
                        <th><?=  lang('ui_even')?></th>
                        <th><?=  lang('ui_datefrom')?></th>
                        <th><?=  lang('ui_dateto')?></th>
                        <th><?=  lang('ui_timestart')?></th>
                        <th><?=  lang('ui_timeend')?></th>
                        <!-- <th><?=  lang('ui_description')?></th> -->
                      </tr>
                    </tfoot>
                    <tbody>
                    <?php
                      //print_r($modeldetail);
                        foreach ($this->M_events->get_list() as $value)
                        {
                      ?>
                          <tr class = "rowdetail" role = "row" id = <?= $value->Id?>>
                            <td><?= $value->Name?></td>
                            <td><?= get_formated_date($value->ActiveDate, 'd-m-Y')?></td>
                            <td><?= get_formated_date($value->InactiveDate, 'd-m-Y')?></td>
                            <td><?= $value->TimeStart?></td>
                            <td><?= $value->TimeEnd?></td>
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
    initadd();
    loadModalEven("#tableModalEven");
  });

  function loadModalEven(idtable){
    $(idtable).DataTable({
      "pagingType": "full_numbers",
      "lengthMenu": [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
      responsive: true,
      language: {
      search: "_INPUT_",
      "search": "<?= lang('ui_search')?>"+" : ",
      }
    });

    var table = $(idtable).DataTable();
     // Edit record
     table.on( 'click', '.rowdetail', function () {
        $tr = $(this).closest('tr');

        var data = table.row($tr).data();
        var id = $tr.attr('id');

        $("#eventid").val(id);
        $("#evenname").val(data[0]);
        $('#modalEven').modal('hide');
     } );
  }

  function initadd(){
    
    $('select#assigntype option[value="<?= $model->AssignType ?>"]').attr("selected",true);

    $('.selectpicker').selectpicker({
      style : 'btn-primary'
    }); 
  }

</script>