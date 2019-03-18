<div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item active"><?= lang('ui_report')?></li>
    </ul>
  </div>
</div>
<section>
  <div class="container-fluid">
    <!-- Page Header-->
    <header> 
          <h1 class="h3 display"><?= lang('ui_report')?> </h1>
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
              <!-- <div class="col-6 text-right">
                <a href="<?= base_url('tjournal/add')?>"><i class = "fa fa-plus"></i> Tambah</a>
              </div> -->
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table data-page-length = "-1" id = "tableReport" style="width: 100%;" class="table dataTable no-footer" role="grid">
                <thead class=" text-primary">
                  <tr role = "row">
                    <!-- <th># </th> -->
                    <th><?=  lang('ui_name')?></th>
                    <th><?=  lang('ui_description')?></th>
                    <th><?=  lang('ui_alias')?></th>
                    <!-- <th class="disabled-sorting text-right"><?=  lang('ui_actions')?></th> -->
                  </tr>
                </thead>
                <tfoot class=" text-primary">
                  <tr role = "row">
                    <!-- <th># </th> -->
                    <th><?=  lang('ui_name')?></th>
                    <th><?=  lang('ui_description')?></th>
                    <th><?=  lang('ui_alias')?></th>
                    <!-- <th class="disabled-sorting text-right"><?=  lang('ui_actions')?></th> -->
                  </tr>
                </tfoot>
                <tbody>
                <?php
                  foreach ($model as $value)
                  {
                ?>
                    <tr role = "row" id = <?= $value->Id?>>
                      <td><a href="<?= $value->Url?>"><?= lang($value->Resource)?></a></td>
                      <td><?= $value->Description?></td>
                      <td><?= lang($value->Resource)?></td>
                      <!-- <td class = "td-actions text-right">
                        <a href="#" rel="tooltip" title="<?=  lang('ui_edit')?>" class="btn btn-link btn-primary btn-just-icon edit"><i class="material-icons">edit</i></a>
                      </td> -->
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
    dataTable();
  });

  function dataTable(){
    $('#tableReport').DataTable({
      "pagingType": "full_numbers",
      "lengthMenu": [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
      "order" : [[0, "asc"]],
      responsive: true,
      language: {
      search: "_INPUT_",
      "search": "<?= lang('ui_search')?>"+" : "
      },
    });
  }

</script>
      