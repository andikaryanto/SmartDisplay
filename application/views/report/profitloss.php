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
          <h1 class="h3 display"><?= lang('ui_profitloss')?> </h1>
      </tr>
    </header>
    <div class="row">

      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <div class = "row">
              <div class="col-sm-6">
                <h4><?= lang('ui_profitloss')?></h4>
              </div>
            </div>
          </div>
          <div class="card-body">                
                <form method = "post" action = "<?= base_url('reports/profitloss_pdf');?>" target="_blank">
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
    
<script>
    var rangetype;
    $(document).ready(function() { 
        initprofitloss();
        rangetype = $('#rangetype').val();
        setFilter();
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

    function initprofitloss(){
        $('.selectpicker').selectpicker({
        style : 'btn-primary'
        }); 
    }

</script>
