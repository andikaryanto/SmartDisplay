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
          <h1 class="h3 display"><?= lang('ui_master_user')?> </h1>
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
                <!-- <a href="<?= base_url('muser')?>"><i class = "fa fa-table"></i> Data</a> -->
              </div>
            </div>
          </div>
          <div class="card-body">                   
            <form method = "post" action = "<?= base_url('muser/addsave');?>">
              <input hidden id = "groupid" type="text" class="form-control" name = "groupid" value="<?= $model->M_Groupuser_Id?>">
              <div class="form-group bmd-form-group">
                <div class = "required">
                  <label class = ""><?= lang('ui_name')?></label>
                  <input id="named" type="text"  class="form-control " name = "named" value="<?= $model->Username?>" required>
                </div>
              </div>
              <div class="form-group">
                <div class = "required">
                  <label><?= lang('ui_group_user')?></label>
                  <div class="input-group has-success">
                    
                    <input id = "groupname" type="text" class="form-control custom-readonly"  value="<?= $model->get_M_Groupuser()->GroupName?>" readonly>
                    <!-- <span class="form-control-feedback text-primary">
                        <i class="material-icons">search</i>
                    </span> -->
                    <div class="input-group-append">
                      <button id="btnGroupModal" data-toggle="modal" type="button" class="btn btn-primary" data-target="#modalGroupUser"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group"> 
                <div class = "required">      
                  <label><?= lang('ui_password')?></label>
                  <input id="password" type="password" class="form-control" name = "password" value="<?= $model->Password?>">
                </div>
              </div>
              <div class="form-group">       
                <input type="submit" value="<?= lang('ui_save')?>" class="btn btn-primary">
                <a href="<?= base_url('muser')?>" value="<?= lang('ui_cancel')?>" class="btn btn-primary"><?= lang('ui_cancel')?></a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- modal -->
<div id="modalGroupUser" tabindex="-1" role="dialog" aria-labelledby="groupUserModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="groupUserModalLabel" class="modal-title">Group User</h5>
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
                  <table data-page-length="<?= $_SESSION[get_variable().'usersettings']['RowPerpage']?>" id = "tableModalGroupUser" class="table table-striped table-no-bordered table-hover dataTable dtr-inline collapsed" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                    <thead class=" text-primary">
                        <th><?=  lang('ui_group_user')?></th>
                        <!-- <th><?=  lang('ui_description')?></th> -->
                    </thead>
                    <tfoot class=" text-primary">
                      <tr role = "row">
                        <!-- <th># </th> -->
                        <th><?=  lang('ui_group_user')?></th>
                        <!-- <th><?=  lang('ui_description')?></th> -->
                      </tr>
                    </tfoot>
                    <tbody>
                    <?php
                      //print_r($modeldetail);
                        foreach ($datamodal['modal_group'] as $value)
                        {
                      ?>
                          <tr class = "rowdetail" role = "row" id = <?= $value->Id?>>
                            <td><?= $value->GroupName?></td>
                            <!-- <td><?= $value->Description?></td> -->
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

<script type = "text/javascript">
  $(document).ready(function() {    
    init();
    loadModalGroup("#tableModalGroupUser");
  });

  function loadModalGroup(idtable){
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

        $("#groupid").val(id);
        $("#groupname").val(data[0]);
        $('#modalGroupUser').modal('hide');
     } );
  }

  function init(){
    
  }
  
</script>