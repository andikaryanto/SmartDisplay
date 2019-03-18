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

      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <div class = "row">
              <div class="col-6">
                <h4><?= lang('ui_data')?></h4>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="material-datatables">
              <div class="table-responsive">
                <table data-page-length="<?= $_SESSION[get_variable().'usersettings']['RowPerpage']?>" id = "tableUser" class="table table-striped table-no-bordered table-hover dataTable dtr-inline collapsed" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                  <thead class=" text-primary">
                      <th><?=  lang('ui_user')?></th>
                      <th><?=  lang('ui_group_user')?></th>
                      <th><?=  lang('ui_isactive')?></th>
                      <th class="disabled-sorting text-right"><?=  lang('ui_actions')?></th>
                  </thead>
                  <tfoot class=" text-primary">
                    <tr role = "row">
                      <!-- <th># </th> -->
                      <th><?=  lang('ui_user')?></th>
                      <th><?=  lang('ui_group_user')?></th>
                      <th><?=  lang('ui_isactive')?></th>
                      <th class="disabled-sorting text-right"><?=  lang('ui_actions')?></th>
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php
                  //print_r($modeldetail);
                    foreach ($model as $value)
                    {
                  ?>
                      <tr role = "row" id = <?= $value->Id?>>
                        <td><a href= "<?= base_url('mplayer/edit/'.$value->Id);?>" class = "text-muted"><?= $value->Name?></a></td>
                        <td><?= $value->get_M_Groupplayer()->GroupName?></td>
                        <?php 
                        if($value->IsActive == 1 ) {
                          $btnclass = "";
                        ?>
                        <td><a><i class='fa fa-check'></i></a></td>
                        <?php
                        } else {
                          $btnclass = "text-danger";
                        ?>
                          <td><a><i class='fa fa-close'></i></a></td>
                        <?php
                        }  
                        ?>
                        
                        <td class = "td-actions text-right">
                          <!-- <a href="#" rel="tooltip" title="<?=  lang('ui_role')?>" class="btn-just-icon link-action role"><i class="fa fa-user"></i></a> -->
                          
                          <a href="#" class="<?= $btnclass ?> btn-just-icon link-action activate"><i class="fa fa-plug"></i></a>
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
        }
      ],
      
      columns: [
        { responsivePriority: 1 },
        { responsivePriority: 3 },
        { responsivePriority: 4 },
        { responsivePriority: 2 }
      ],
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
    <?php 
      if($this->session->flashdata('success_msg'))
      {
        $msg = $this->session->flashdata('success_msg');
        for($i=0 ; $i<count($msg); $i++)
        {
      ?>
          setNotification("<?= lang($msg[$i]); ?>", 2, "bottom", "right");
      <?php 
        }
      }
    ?>
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
      