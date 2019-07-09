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
          <h1 class="h3 display"><?= lang('ui_master_player')?> </h1>
      </tr>
    </header>
    <div class="row">
      
      <!-- <div class = "col-lg-12 text-danger text-right">
        <?= lang('ui_slotleft')." : ". $this->M_players->slotLeft();?>
      </div> -->
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <div class = "row">
              <div class="col-6">
                <h4><?= lang('ui_data')?></h4>
              </div>
              <div class="col-6 text-right">
                <a href="<?= base_url('mplayer/add')?>"><i class = "fa fa-plus"></i> Tambah</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="material-datatables">
              <div class="table-responsive">
                <table data-page-length="<?= $_SESSION[get_variable().'usersettings']['RowPerpage']?>" id = "tableUser" class="table table-striped table-no-bordered table-hover dataTable dtr-inline collapsed" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                  <thead class=" text-primary">
                      <th><?=  lang('ui_player')?></th>
                      <th><?=  lang('ui_groupplayer')?></th>
                      <th><?=  lang('ui_isactive')?></th>
                      <th class="disabled-sorting text-right"><?=  lang('ui_actions')?></th>
                  </thead>
                  <tfoot class=" text-primary">
                    <tr role = "row">
                      <!-- <th># </th> -->
                      <th><?=  lang('ui_player')?></th>
                      <th><?=  lang('ui_groupplayer')?></th>
                      <th><?=  lang('ui_isactive')?></th>
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
  </div>
</section>
<script type = "text/javascript">
  $(document).ready(function() {    
    init();
    dataTable();
  });

  function dataTable(){
    var table = $('#tableUser').DataTable({
      "pagingType": "full_numbers",
      "lengthMenu": [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
      responsive: true,
      language: {
      search: "_INPUT_",
      "search": "<?= lang('ui_search')?>"+" : "
      },
      "columnDefs": [ 
        {
          targets: 'disabled-sorting', 
          orderable: false
        },
        {
           "className": "td-actions text-right", 
           "targets": [ 3 ] 
        }
      ],
      
      columns: [
        { responsivePriority: 1 },
        { responsivePriority: 3 },
        { responsivePriority: 4 },
        { responsivePriority: 2 }
      ],
      "processing": true,
      "serverSide": true,
      ajax:{
        url : "<?= base_url('M_player/getAllData')?>",
        dataSrc : 'data'
      },
      stateSave: true
    }); 

     // Edit record
     table.on( 'click', '.edit', function () {
        $tr = $(this).closest('tr');

        var id = $tr.attr('id');
        window.location = "<?= base_url('mplayer/edit/');?>" + id;
     } );

     // Delete a record
     table.on( 'click', '.activate', function (e) {
        $tr = $(this).closest('tr');
        var data = table.row($tr).data();
        var id = $tr.attr('id');
        window.location = "<?= base_url('mplayer/activate/');?>" + id;
     });
  }

  function init(){
    
  }

  function delete_user(id, name){
    deleteData(name, function(result){
      if (result==true)
        window.location = "<?= base_url('mplayer/delete/');?>" + id;
    });
  } 
  function activate_user(id){
    window.location = "<?= base_url('mplayer/activate/');?>" + id;
  }
</script>
      