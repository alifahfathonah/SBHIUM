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
            <h2>Barang <small>Data Barang</small></h2>
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
            <th>Kode Barang</th>
						<th>Nama Barang</th>
            <th>Keterangan</th>
						<th>Action</th>
					</tr>
				</thead>
			</table>
          </div>
        </div>
			<div id="box"></div><!-- Loader -->
			<a href="<?= $this->createUrl('/admin/barang/add') ?>" role="button" class="btn btn-primary <?= Yii::app()->user->getState('role')!=1?'disabled':'';?>"><i class="icon-plus"></i> Tambah Barang</a>
      </div>
    </div>
</div>

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
				{"bSortable": true,"sName": "t.kode_barang"},
				{"bSortable": true,"sName": "t.nama_barang"},
				{"bSortable": true,"sName": "t.keterangan"},
				{"bSortable": false,"sName": "action"}
				]
		});
     var htmlSearch = '<select id="searchField" class="form-control input-sm">'+
			'<option value="">--Field--</option>'+
			'<option value="0">Kode Barang</option>'+
			'<option value="1">Nama Baranag</option>'+
			'<option value="2">Keterangan</option>'+
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