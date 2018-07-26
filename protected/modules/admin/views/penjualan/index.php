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
            <h2>Penjualan <small>Data Penjualan</small></h2>
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
            <table id="data" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Tanggal</th>
                  <th>Nama Barang</th>
                  <th>Jumlah Item</th>
                  <th>Laba</th>
                  <th>Keterangan</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                  <tr>
                      <th style="text-align:right" colspan="3">Total per page</th>
                      <th style="text-align: right"></th>
                      <th></th>
                      <th></th>
                  </tr>
                  <tr>
                      <th style="text-align:right" colspan="3">Grand Total</th>
                      <th style="text-align:right" id="grandValue"></th>
                      <th></th>
                      <th></th>
                  </tr>
              </tfoot>
            </table>
          </div>
        </div>
      <div id="box"></div><!-- Loader -->
      <a href="<?= $this->createUrl('/admin/penjualan/add') ?>" role="button" class="btn btn-primary <?= Yii::app()->user->getState('role')!=1?'disabled':'';?>"><i class="icon-plus"></i> Tambah Penjualan</a>
      </div>
    </div>
</div>
<style type="text/css">
  td.alignRight { text-align: right; }
</style>
<script type="text/javascript">
      var oTable = $('#data').dataTable({
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
              var gt = data.grandTotal ? 'Rp. '+number_format(data.grandTotal,0,'.',',') : 0;
              $('#grandValue').html(gt);
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
      {"bSortable": true,"sName": "tanggal"},
      {"bSortable": true,"sName": "tBarang.nama_barang"},
      {"bSortable": true,"sName": "t.jumlah"},
      {"bSortable": true,"sName": "t.laba","sClass":"alignRight"},
      {"bSortable": true,"sName": "t.keterangan"},
      {"bSortable": false,"sName": "action"}
      ],

      /*Total*/
      "fnFooterCallback": function ( nRow, aaData, iStart, iEnd, aiDisplay ) {
          /*
           * Calculate the total market share for all browsers in this table (ie inc. outside
           * the pagination)
           */
          var iTotalAmount = 0;
          for ( var i=0 ; i<aaData.length ; i++ )
          {
              iTotalAmount += aaData[i][3].replace(/[\$,]/g, '')*1;
          }
          /* Modify the footer row to match what we want */
           /*Total Footer*/   
          var nCells = nRow.getElementsByTagName('th');
          nCells[1].innerHTML = 'Rp. '+number_format(iTotalAmount,0,'.',',');

      }
      /*EndTotal*/

    });
     var htmlSearch = '<select id="searchField" class="form-control input-sm" onchange="applySearchInput(this,\'searchText\')">'+
      '<option value="">--Field--</option>'+
      '<option value="0" data-type="date">Tanggal</option>'+
      '<option value="1">Nama Barang</option>'+
      '<option value="2">Jumlah</option>'+
      '<option value="3">Laba</option>'+
      '<option value="4">Keterangan</option>'+
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