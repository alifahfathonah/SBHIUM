 <div class="">
  <!-- <div class="page-title">
      <div class="title_left">
        <h3>Form Elements</h3>
      </div>
    </div> -->
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Slot <small>Data Transaksi Slot</small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Settings 1</a>
                  </li>
                  <li><a href="#">Settings 2</a>
                  </li>
                </ul>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content" style="display: block;">
            <br>
            <table id="data" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Nama Investor</th>
                  <th>Debit</th>
                  <th>Kredit</th>
                  <th>Slot Akhir</th>
                  <th>Tanggal Input</th>
                  <th>Tanggal Active</th>
                  <th>Keterangan</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                  <tr>
                      <th style="text-align:right" colspan="1">Total Slot</th>
                      <th id="totalSlot" colspan="7"></th>
                  </tr>
              </tfoot>
            </table>
          </div>
        </div>
      <div id="box"></div><!-- Loader -->
      <a href="<?= $this->createUrl('/admin/slot/add') ?>" role="button" class="btn btn-primary <?= Yii::app()->user->getState('role')!=1?'disabled':'';?>"><i class="icon-plus"></i> Input Slot</a>
      </div>
    </div>
</div>
<style type="text/css">
  td.alignRight { text-align: right; }
  .merah{
    background-color: #E74C3C;
    color: white;
  }
  .kuning{
    background-color: #f0ad4e;
    color: white;
  }
  .hijau{
    background-color: #1ABB9C;
    color: white;
  }
  .biru{
    background-color: blue;
    color: white;
  }
  .ungu{
    background-color: #9B59B6;
    color: white;
  }
  .birumuda{
    background-color: #9CC2CB;
    color: white;
  }
  .abumuda{
    background-color: #73879C;
    color: white;
  }
  .abutua{
    background-color: #72907f;
    color: white;
  }
  .coklataneh{
    background-color: #555;
    color: white;
  }
  .putih{
    background-color: #ffffff;
    color: #555;
  }
  .birugelap{
    background-color: #34495E;
    color: white;
  }
  .chartreuse{
    background-color: chartreuse;
    color: white;
  }
  .violet{
    background-color: violet;
    color: white;
  }
  .turquoise{
    background-color: turquoise;
    color: white;
  }
  .thistle{
    background-color: thistle;
    color: thistle;
  }
  .tan{
    background-color: tan;
    color: tan;
  }
  .slateblue{
    background-color: slateblue;
    color: slateblue;
  }
</style>
<script type="text/javascript">
      var oTable = $('#data').dataTable({
          "createdRow": function( row, data, dataIndex ) {
            /*Bikin Array class*/
            var randomClass = ['merah','kuning','hijau','biru','ungu','birumuda','abumuda','abutua','coklataneh','putih','birugelap','chartreuse','violet','turquoise','thistle','tan','slateblue'];
            /*Bikin Array class*/
            var neww = [];
            /*Bikin Array baru untuk parameter penyama nama investor dari data investor reference controller*/
             $(data[8]).each(function( i, element ) {
                var value = element;
                neww.push(value);
              });
             /*Bikin Array baru untuk parameter penyama nama investor dari data investor reference controller*/
             /*Proses penyamaan nama antara data dan investor untuk membedakan background berdasarkan nama investor*/
              for(i = 0; i < neww.length; i++) {
                if ( data[0] == neww[i] ) {
                  $(row).addClass(randomClass[i]);
                }
              }
              /*Proses penyamaan nama antara data dan investor untuk membedakan background berdasarkan nama investor*/
          },

        "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
        "sPaginationType": "full_numbers",
        "oLanguage": {
          "sLengthMenu": "_MENU_ records per page"
        },
        "bProcessing": true,
        "sAjaxSource": '<?= Yii::app()->baseUrl . '/' . $this->module->id . '/' .$this->id . '/' . $this->action->id  ?>',
        "bServerSide": true,
        "sServerMethod": "POST",
        "fnServerData": function ( sSource, aoData, fnCallback,oSettings ) {
          oSettings.jqXHR = $.ajax({
          "dataType": 'json',
          "type": "POST",
          "url": sSource,
          "data": aoData,        
          "success": function(data){
            //For Grand Total
              var gt = data.grandTotal ? data.grandTotal : 0;
              $('#totalSlot').html(gt);

            //End Grand Total
            fnCallback(data);
            if(data.hasError){
                parent.$.fancybox.open([
                {      
              content : data.htmlError,
              afterClose : function(){
                  if(data.returnUrl!=undefined && data.returnUrl!=''){
                location.href =  data.returnUrl;
                  }
              }
                }])
            }
          }
         })
        },
      //    "fnServerParams": function ( aoData ) {
        // aoData.push( {});
      //     },
      "aoColumns": [
      {"bSortable": true,"sName": "tUserAccount.Fullname"},
      {"bSortable": true,"sName": "debit"},
      {"bSortable": true,"sName": "kredit"},
      {"bSortable": true,"sName": "slot_akhir"},
      {"bSortable": true,"sName": "t.input_date"},
      {"bSortable": true,"sName": "t.active_date"},
      {"bSortable": true,"sName": "t.keterangan"},
      {"bSortable": false,"sName": "action"}
      ],

    });
     var htmlSearch = '<select id="searchField" class="form-control input-sm" onchange="applySearchInput(this,\'searchText\')">'+
      '<option value="">--Field--</option>'+
      '<option value="0">Nama Investor</option>'+
      '<option value="1">Debit</option>'+
      '<option value="2">Kredit</option>'+
      '<option value="3">Slot Akhir</option>'+
      '<option value="4" data-type="date">Tanggal input</option>'+
      '<option value="5" data-type="date">Tanggal Aktif</option>'+
      '<option value="6">Keterangan</option>'+
          '</select>';
    $('#data_filter').html('<div style="float:right;">'+htmlSearch+'&nbsp; <input class="form-control input-sm" type="text" id="searchText" /><a class="btn btn-default" id="searchButton">Search</a></div>');

    /*delete*/
    /*Delete Function*/
    $('#data').on("click","#deleterow",function(e){
        $('#gagal').remove();
    $('#sukses').remove();
        e.preventDefault();
        var ask = confirm('Delete data ?');
          if(ask){
            ajaxindicatorstart('Mohon tunggu');
                var url = $(this).attr('href');
              $.ajax({
                    type:'POST',
                    url:url,
                    success: function(data){
                         if(data=="YES"){
                      ajaxindicatorstop();
                            $('#box').html('<div id="sukses" class="alert alert-success alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Sukses!</strong> Data berhasil dihapus.</div>');
              $('#box #sukses').focus();
                            $('#data').DataTable().ajax.reload();
                         }else{
                      ajaxindicatorstop();
                            $('#box').html('<div id="gagal" class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Maaf!</strong> Gagal menghapus data.</div>');
                         }
                    },
                    error: function(xhr, textStatus, errorThrown){
                      ajaxindicatorstop();
                      $('#box').html('<div id="gagal" class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Maaf!</strong> Gagal menghapus data.</div>');
                    }
               });
          }
    });
</script>