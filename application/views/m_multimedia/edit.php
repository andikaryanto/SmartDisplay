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
          <h1 class="h3 display"><?= lang('ui_master_multimedia')?> </h1>
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
                <a href="<?= base_url('mmultimedia')?>"><i class = "fa fa-table"></i> Data</a>
              </div>
            </div>
          </div>
          <div class="card-body">                
            <form method = "post" action = "<?= base_url('mmultimedia/editsave');?>" enctype= "multipart/form-data">
              <input hidden name ="idmultimedia" id="idmultimedia" value="<?= $model->Id?>">
              <input hidden id = "eventid" name = "eventid" value ="<?= $model->M_Event_Id?>">
              <div class="form-group">
                <div class = "required">
                  <label><?= lang('ui_name')?></label>
                  <input id="named" type="text" placeholder="<?= lang('ui_name') ?>" class="form-control" name = "named" value="<?= $model->Name?>" required>
                </div>
              </div>
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
              <div class="row" >
                <div class="col-md-6">
                  <div class="form-group">   
                    <div class = "required">    
                      <label><?= lang('ui_type')?></label>
                      <select id ="type" class="selectpicker form-control" name = 'type'>
                      <?php foreach($this->M_enums->get_data_by_id(2) as $itemstatus) { ?>
                        <option value ="<?= $itemstatus->Value?>"><?= lang($itemstatus->Resource)?></option>
                      <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">   
                    <div class = "required">       
                      <label><?= lang('ui_assigntype')?></label>
                      <select id ="assigntype" class="selectpicker form-control" name = 'assigntype'>
                      <?php foreach($this->M_enums->get_data_by_id(3) as $itemstatus) { ?>
                        <option value ="<?= $itemstatus->Value?>"><?= lang($itemstatus->Resource)?></option>
                      <?php } ?>
                      </select>
                      <small class="form-text text-primary">Note : <?= lang('info_change_assign_type')?></small>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                  <label><?= lang('ui_showtime')?></label>
                  <input id="showtime" type="text" placeholder="<?= lang('ui_showtime') ?>" class="form-control showtime" name = "showtime" value="<?= $model->ShowTime?>">
                  <small class="form-text text-primary"><?= lang('info_showtime')?></small>
                
              </div>
              <div class="row" >
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
                <a href="<?= base_url('mmultimedia')?>" value="<?= lang('ui_cancel')?>" class="btn btn-primary"><?= lang('ui_cancel')?></a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section>
  <div class="container-fluid">
    <!-- Page Header-->
   
    <div class="row">

      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <div class = "row">
              <div class="col-6">
                <h4><?= lang('ui_player')?></h4>
              </div>
              <div class="col-6 text-right">
                <a href="javascript:saveDetail();" class ="link-action"><i class = "fa fa-save "></i></a>
                <a href="javascript:lookUpPlayer();" class ="link-action"><i class = "fa fa-plus"></i></a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id = "tablePlayerMultimedia" style="width: 100%;" class="table table-striped table-no-bordered table-hover dataTable dtr-inline collapsed" role="grid">
                <thead class=" text-primary">
                  <tr role = "row">
                    <!-- <th># </th> -->
                    <th>Id</th>
                    <th><?=  lang('ui_player')."/".lang('ui_groupplayer')?></th>
                    <th class="disabled-sorting text-right"><?=  lang('ui_actions')?></th>
                  </tr>
                </thead>
                <tfoot class=" text-primary">
                  <tr role = "row">
                    <!-- <th># </th> -->
                    <th>Id</th>
                    <th><?=  lang('ui_player')."/".lang('ui_groupplayer')?></th>
                    <th class="disabled-sorting text-right"><?=  lang('ui_actions')?></th>
                  </tr>
                </tfoot>
              </table>
            </div>
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

  <!-- modal -->
<div id="modalPlayer" tabindex="-1" role="dialog" aria-labelledby="playerModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="playerModalLabel" class="modal-title"><?=  lang('ui_player')?></h5>
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
                  <table data-page-length="5" id = "tablePlayer" class="table table-striped table-no-bordered table-hover dataTable dtr-inline collapsed" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                  <thead class=" text-primary">
                      <th>Id</th>
                      <th><?=  lang('ui_player')?></th>
                      <th><?=  lang('ui_groupplayer')?></th>
                  </thead>
                  <tfoot class=" text-primary">
                    <tr role = "row">
                      <th>Id</th>
                      <th><?=  lang('ui_player')?></th>
                      <th><?=  lang('ui_groupplayer')?></th>
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php
                  //print_r($modeldetail);
                    foreach ($this->M_players->get_list() as $value)
                    {
                      if($value->IsActive && !$value->isExistInMultimedia($model->Id)){
                  ?>
                      <tr role = "row" id = <?= $value->Id?>>
                        <td><?= $value->Id?></td>
                        <td><?= $value->Name?></td>
                        <td><?= $value->get_M_Groupplayer()->GroupName?></td>
                        
                      </tr>
                  <?php
                      }
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


  <!-- modal -->
<div id="modalGroupPlayer" tabindex="-1" role="dialog" aria-labelledby="groupPlayerModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="groupPlayerModalLabel" class="modal-title"><?=  lang('ui_groupplayer')?></h5>
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
                  <table data-page-length="5" id = "tableModalGroupPlayer" class="table table-striped table-no-bordered table-hover dataTable dtr-inline collapsed" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                    <thead class=" text-primary">
                        <th>Id</th>
                        <th><?=  lang('ui_groupplayer')?></th>
                        <th><?=  lang('ui_description')?></th>
                    </thead>
                    <tfoot class=" text-primary">
                      <tr role = "row">
                        <!-- <th># </th> -->
                        <th>Id</th>
                        <th><?=  lang('ui_groupplayer')?></th>
                        <th><?=  lang('ui_description')?></th>
                      </tr>
                    </tfoot>
                    <tbody>
                    <?php
                      //print_r($modeldetail);
                        foreach ($this->M_groupplayers->get_list() as $value)
                        {
                          if(!$value->isExistInMultimedia($model->Id)){
                      ?>
                          <tr class = "rowdetail" role = "row" id = <?= $value->Id?>>
                            <td><?= $value->Id?></td>
                            <td><?= $value->GroupName?></td>
                            <td><?= $value->Description?></td>
                          </tr>
                      <?php
                          }
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
  var url = "<?= base_url('M_multimedia/adddetailplayer?idmultimedia='.$model->Id.'&assigntype='.$model->AssignType)?>";
  var tablePlayer;
  var tableGroupPlayer;
  var tablePlayerMultimedia;
  var getParams="";
  var playergrup = [];
  var modalPlayerOnClose = false;

  $(document).ready(function() { 
    initadd();
    loadModalEven("#tableModalEven");
    dataTable();
    loadPlayer();
    loadGroupPlayer();
  });

  $('#modalPlayer').on('hidden.bs.modal', function (e) {
    // tablePlayer.rows().deselect();
    // modalPlayerOnClose = true;
  })

  function lookUpPlayer(){
    if($("#assigntype").val() == 1){
      $("#modalPlayer").modal('show');
    } else {
      $("#modalGroupPlayer").modal('show');
    }
  }

  function dataTable(){
    tablePlayerMultimedia = $('#tablePlayerMultimedia').DataTable({
      "pagingType": "full_numbers",
      "lengthMenu": [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
      "order" : [[1, "desc"]],
      responsive: true,
      language: {
        search: "_INPUT_",
        "search": "<?= lang('ui_search')?>"+" : "
      },
      "columnDefs": [ 
        {
          "targets": 2,
          "data": null,
          "defaultContent": '<a href="#" rel="tooltip" title="<?=  lang('ui_delete')?>" class="btn-just-icon link-action text-right delete"><i class="fa fa-trash"></i></a>'
        },
        {
          targets: 'disabled-sorting', 
          orderable: false
        },
        {
          targets: 0, 
          visible : false,
          searchable: false,
          orderable: false
        }
      ],
      columns: [
        { responsivePriority: 2 },
        { responsivePriority: 3 },
        { responsivePriority: 1 }
      ],
      ajax: {
        url : url+getParams,
        dataSrc : 'data'
      },
      columns: [
        { 
          "data": "Id"
        },
        { 
          "data": "PlayerName"
        },
        { 
          "data": ""
        }
      
        
      ]
    }); 

     // Delete a record
     
     tablePlayerMultimedia.on( 'click', '.delete', function (e) {

      $tr = $(this).closest('tr');
      var row = tablePlayerMultimedia.row( $(this).parents('tr') );
      var data = row.data();
      // console.log(data);
      // row.remove().draw();
      deleteData(data['PlayerName'], function(result){
        if(result == true){
          if(data['Id'] != undefined){
            $.ajax({
              url : "<?= base_url('M_multimedia/deleteDetail')?>",
              type: "POST",
              data : {
                id: data['Id'],
              },
              success : function(data){
                // location.reload();
              }
            });
          }
        }
      });
      row.remove().draw();
     });
  }

  function loadPlayer(){
    tablePlayer = $('#tablePlayer').DataTable({
      "pagingType": "full_numbers",
      "lengthMenu": [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
      "order" : [[0, "desc"]],
      select: {
        style: 'multi'
      },
      "columnDefs": [
        {
            "targets": [ 0 ],
            "visible": false,
            "searchable": false
        }
      ],
      responsive: true,
      language: {
        search: "_INPUT_",
        "search": "<?= lang('ui_search')?>"+" : "
      },
    }); 

     // Delete a record
     tablePlayer.on('select', function ( e, dt, type, indexes ) {
      if ( type === 'row' ) {
          var data = tablePlayer.rows( indexes ).data().pluck( 'id' );
          playergrup.push(parseInt(tablePlayer.rows( indexes ).data()[0][0]));
          getParams = "&idplayergroup="+JSON.stringify(playergrup);
          console.log(url+getParams);
          reloadDtTable(tablePlayerMultimedia, url+getParams);
      }
    });

    tablePlayer.on('deselect', function ( e, dt, type, indexes ) {
      if ( type === 'row' ) {
          var data = tablePlayer.rows( indexes ).data().pluck( 'id' );
  
          playergrup.pop(parseInt(tablePlayer.rows( indexes ).data()[0][0]));
          var splicedData = playergrup.indexOf(parseInt(tablePlayer.rows( indexes ).data()[0][0]));
          if (splicedData != -1) {
            playergrup.splice(splicedData, 1);   
          }
          getParams = "&idplayergroup="+JSON.stringify(playergrup);
          reloadDtTable(tablePlayerMultimedia, url+getParams);
      }
    });
     
  }

  function reloadDtTable(table, url){
    table.ajax.url(url).load();
  }

  function loadGroupPlayer(){
    tableGroupPlayer = $('#tableModalGroupPlayer').DataTable({
      "pagingType": "full_numbers",
      "lengthMenu": [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
      "order" : [[0, "desc"]],
      select: {
        style: 'multi'
      },
      responsive: true,
      language: {
        search: "_INPUT_",
        "search": "<?= lang('ui_search')?>"+" : "
      },
      "columnDefs": [ 
        
        {
            "targets": [ 0 ],
            "visible": false,
            "searchable": false
        }
      ],
      columns: [
        { responsivePriority: 2 },
        { responsivePriority: 3 },
        { responsivePriority: 1 }
      ],
    }); 

     // Delete a record
     tableGroupPlayer.on('select', function ( e, dt, type, indexes ) {
      if ( type === 'row' ) {
          var data = tableGroupPlayer.rows( indexes ).data().pluck( 'id' );
          playergrup.push(parseInt(tableGroupPlayer.rows( indexes ).data()[0][0]));
          getParams = "&idplayergroup="+JSON.stringify(playergrup);
          console.log(url+getParams);
          reloadDtTable(tablePlayerMultimedia, url+getParams);
      }
    });

    tableGroupPlayer.on('deselect', function ( e, dt, type, indexes ) {
      if ( type === 'row' ) {
          var data = tableGroupPlayer.rows( indexes ).data().pluck( 'id' );
  
          playergrup.pop(parseInt(tableGroupPlayer.rows( indexes ).data()[0][0]));
          var splicedData = playergrup.indexOf(parseInt(tableGroupPlayer.rows( indexes ).data()[0][0]));
          if (splicedData != -1) {
            playergrup.splice(splicedData, 1);   
          }
          getParams = "&idplayergroup="+JSON.stringify(playergrup);
          reloadDtTable(tablePlayerMultimedia, url+getParams);
      }
    });
     
  }
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

  function saveDetail(){
    var playerid = JSON.stringify(playergrup);
    $.ajax({
      url : "<?= base_url('M_multimedia/saveDetail')?>",
      type: "POST",
      data : {
        multimediaId: "<?= $model->Id?>",
        assigntype : "<?= $model->AssignType?>",
        idplayergroup : playerid
      },
      success : function(data){
        location.reload();
      }
    });
  }

  function initadd(){
    
    $('select#type option[value="<?= $model->Type ?>"]').attr("selected",true);
    $('select#assigntype option[value="<?= $model->AssignType ?>"]').attr("selected",true);
    $('.selectpicker').selectpicker({
      style : 'btn-primary'
    }); 
  }

  
  $('#assigntype').on('change', function(e){
        confirmAlert("Semua Player akan dihapus, lanjutkan?", function(result){
          if(result == true){
            deleteAllPlayer()
          } else {
            location.reload();
          }
        });
  });

  function deleteAllPlayer(){
    $.ajax({
      url : "<?= base_url('M_multimedia/deleteAllPlayer')?>",
      type : "POST",
      data : {
        multimediaid : "<?= $model->Id?>"
      },
      success : function(e){
        // location.reload();
      }
    });
  }

  $('#type').on('change', function(e){


    var myfile = document.getElementById("file");
    if($(this).val() == 1){
      myfile.accept = "image/jpg, image/jpeg, image/png";
    } else {
      myfile.accept = "video/*";
    }
  });
</script>