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
          <h1 class="h3 display"><?= lang('ui_trialbalance')?> </h1>
      </tr>
    </header>
    <div class="row">

      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <div class = "row">
              <div class="col-sm-6">
                <h4><?= lang('ui_trialbalance')?></h4>
              </div>
            </div>
          </div>
          <div class="card-body">                
                <form method = "post" action = "<?= base_url('reports/trialbalance_pdf');?>" target="_blank">
                    <div class="row" >
                        <div class="col-md-6">
                            <div class="form-group">       
                                <label><?= lang('ui_type')?></label>
                                <select id ="rangetype" class="selectpicker form-control" name = 'rangetype'>
                                <?php foreach($this->M_enums->get_data_by_id(4) as $itemstatus) { ?>
                                    <option value ="<?= $itemstatus->Value?>"><?= lang($itemstatus->Resource)?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div id = "rangeselect" class="col-md-6">
                            <div class="form-group">       
                                <label><?= lang('ui_option')?></label>
                                <select id ="range" class="selectpicker form-control" name = 'range'>
                                
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id = "daterange" class = "row">
                      <div class = "col-md-6">
                        <div class="form-group">  
                          <label><?= lang('ui_datefrom')?></label>
                          <input id="datefrom" type="text" class="form-control datepicker" name = "datefrom" autocomplete="off">
                        </div>
                      </div>
                      <div class = "col-md-6">
                        <div class="form-group">  
                          <label><?= lang('ui_dateto')?></label>
                          <input id="dateto" type="text" class="form-control datepicker" name = "dateto" autocomplete="off">
                        </div>
                      </div>
                    </div>
                    <!-- <div class = "row">
                      <div class = "col-md-12">
                        <div class="form-group">
                          <label><?= lang('ui_submission')?></label>
                          <div class="input-group has-success">
                            
                            <input hidden id = "submissionid" type="text" class="form-control" name = "submissionid" >
                            <input id = "submissionname" type="text" class="form-control custom-readonly" readonly>
                            
                            <div class="input-group-append">
                              <button id="btnCityModal" data-toggle="modal" type="button" class="btn btn-primary btn-lookup" data-target="#modalSubmissions"><i class="fa fa-search"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div> -->
                    <div class="form-group">   
                      <button type="submit" name ="print" value="<?= lang('ui_print')?>" class="btn btn-primary" ><?= lang('ui_print')?></button>
                      <button type="submit" name ="preview" value="<?= lang('ui_preview')?>" class="btn btn-primary" ><?= lang('ui_preview')?></button>
                      <a href="<?= base_url('report')?>" value="<?= lang('ui_cancel')?>" class="btn btn-primary"><?= lang('ui_cancel')?></a>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
    
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
                        foreach ($this->M_chartofaccounts->get_list() as $value)
                        {
                          if($value->isLowLevel()){
                          
                      ?>
                          <tr class = "rowdetail" role = "row" id = "<?= $value->Id?>">
                            <td><?= $value->Code?></td>
                            <td><?= $value->Name?></td>
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
    var rangetype;
    $(document).ready(function() { 
        inittrialbalance();
        rangetype = $('#rangetype').val();
        setFilter();
        loadModal();
    });

    $('#rangetype').on("change", function(e){
        rangetype = $(this).val();
        setFilter();
    })


    function setFilter(){
        console.log(rangetype);
        var daterange = document.getElementById('daterange');
        var rangeselect = document.getElementById('rangeselect');
        if(rangetype == 1){
            daterange.style.visibility = "visible";
            rangeselect.style.visibility = "hidden";
        } else if (rangetype == 5){

            daterange.style.visibility = "hidden";
            rangeselect.style.visibility = "hidden";
        } else {
            daterange.style.visibility = "hidden";
            rangeselect.style.visibility = "visible";
            if(rangetype == 2)
                populateRangeSelect(1);
            if(rangetype == 3)
                populateRangeSelect(5);
            if(rangetype == 4)
                populateRangeSelect(6);
        }
    }

    function populateRangeSelect(id){
        getRangeSelect(id, function(result){
            console.log(result);
            $('#range').find('option')
                .remove()
                .end();
            var select = document.getElementById('range');
            for(var i = 0 ; i < result['model'].length; i++){
                var opt = document.createElement('option');
                opt.value = result['model'][i].Value;
                opt.innerHTML = result['model'][i].EnumName;
                select.appendChild(opt);
                $('#range').selectpicker('refresh');
            }
        });
    }

    function getRangeSelect(id, callback){
        $.ajax({
            url : "<?= base_url('M_enum/getEnumsDetailById')?>",
            type : "POST",
            data : {
                id : id
            },
            success : function (data){
                callback(JSON.parse(data));
            }
        });
    }

    function inittrialbalance(){
        $('.selectpicker').selectpicker({
        style : 'btn-primary'
        }); 
    }

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

</script>
