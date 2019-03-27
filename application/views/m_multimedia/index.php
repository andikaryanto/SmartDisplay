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
                <a href="<?= base_url('mmultimedia/add')?>"><i class = "fa fa-plus"></i> Tambah</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id = "tableGroupUser" style="width: 100%;" class="table table-striped table-no-bordered table-hover dataTable dtr-inline collapsed" role="grid">
                <thead class=" text-primary">
                  <tr role = "row">
                    <!-- <th># </th> -->
                    <th><?=  lang('ui_name')?></th>
                    <th><?=  lang('ui_even')?></th>
                    <th><?=  lang('ui_type')?></th>
                    <th><?=  lang('ui_assigntype')?></th>
                    <th><?=  lang('ui_createat')?></th>
                    <th class="disabled-sorting text-right"><?=  lang('ui_actions')?></th>
                  </tr>
                </thead>
                <tfoot class=" text-primary">
                  <tr role = "row">
                    <!-- <th># </th> -->
                    <th><?=  lang('ui_name')?></th>
                    <th><?=  lang('ui_even')?></th>
                    <th><?=  lang('ui_type')?></th>
                    <th><?=  lang('ui_assigntype')?></th>
                    <th><?=  lang('ui_createat')?></th>
                    <th class="disabled-sorting text-right"><?=  lang('ui_actions')?></th>
                  </tr>
                </tfoot>
                <tbody>
                <?php
                  foreach ($model as $value)
                  {
                ?>
                    <tr role = "row" id = <?= $value->Id?>>
                      <td><a href= "<?= base_url('mmultimedia/edit/'.$value->Id);?>" class = "text-muted"><?= $value->Name?></a></td>
                      <td><?= $value->get_M_Event()->Name?></td>
                      <td><?= getEnumName('MultimediaType', $value->Type)?></td>
                      <td><?= getEnumName('MultimediaAssignType', $value->AssignType)?></td>
                      <td><?= $value->Created?></td>
                      <td class = "td-actions text-right">
                        <a href="#" rel="tooltip" title="<?=  lang('ui_delete')?>" class="btn-just-icon link-action delete"><i class="fa fa-trash"></i></a>
                      </td>
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
</section>

<script>

  $(document).ready(function() {   
    
    init();
    dataTable();
  });

  function dataTable(){
    var table = $('#tableGroupUser').DataTable({
      "pagingType": "full_numbers",
      "lengthMenu": [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
      "order" : [[4, "desc"]],
      responsive: true,
      language: {
      search: "_INPUT_",
      "search": "<?= lang('ui_search')?>"+" : "
      },
      "columnDefs": [ 
        {
          targets: 'disabled-sorting', 
          orderable: false
        }
      ],
      columns: [
        { responsivePriority: 1 },
        { responsivePriority: 3 },
        { responsivePriority: 4 },
        { responsivePriority: 5 },
        { responsivePriority: 6 },
        { responsivePriority: 2 }
      ],
    }); 

     // Delete a record
     table.on( 'click', '.delete', function (e) {
        $tr = $(this).closest('tr');
        var data = table.row($tr).data();
        var id = $tr.attr('id');
        console.log(data[0]);
        deleteData(data[0], function(result){
          if (result==true)
          {
            
            $.ajax({
              type : "POST",
              url : "<?= base_url('mmultimedia/delete/');?>",
              data : {id : id},
              success : function(data){
                var status = $.parseJSON(data);
                if(status['isforbidden']){
                  window.location = "<?= base_url('Forbidden');?>";
                } else {
                  if(!status['status']){
                    for(var i=0 ; i< status['msg'].length; i++){
                      var message = status['msg'][i];
                      setNotification(message, 3, "bottom", "right");
                    }
                  } else {
                    for(var i=0 ; i< status['msg'].length; i++){
                      var message = status['msg'][i];
                      setNotification(message, 2, "bottom", "right");
                    }
                    table.row($tr).remove().draw();
                    e.preventDefault();
                  }
                }
              }
            });
          }
        });
     });
  }

  function init(){
    
  }
</script>
      