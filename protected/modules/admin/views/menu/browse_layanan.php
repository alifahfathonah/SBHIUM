<style type='text/css'>
.pagination ul > li > a, .pagination ul > li > span {
float: left;
padding: 4px 8px;
line-height: 20px;
text-decoration: none;
background-color: #ffffff;
border: 1px solid #dddddd;
border-left-width: 0;
}
</style>

<table id="data" class="table table-striped table-hover" >
	<thead>
		<tr>
			<th width="20px"></th>
			<th>ID</th>
			<th>Title</th>
		</tr>
	</thead>
</table><br>
<div align="right"><a onclick="check()" class="btn btn-primary">Insert Link</a></div>
<script type="text/javascript">
			var oTable = $('#data').dataTable({
		    "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
		    "sPaginationType": "bootstrap",
		    "oLanguage": {
			    "sLengthMenu": "_MENU_ records per page"
		    },
		    "bProcessing": true,
		    "sAjaxSource": '<?= Yii::app()->baseUrl . '/' . $this->module->id . '/' .$this->id . '/'?>json',
		    "bServerSide": true,
		    "sServerMethod": "POST",
		    "bFilter": true,
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
		     "fnServerParams": function ( aoData ) {
			aoData.push();
	      },
		    "aoColumns": [
				{"bSortable": false,"sName": "id"},
				{"bSortable": true,"sName": "id"},
				{"bSortable": true,"sName": "title"}
				]
		});
     var htmlSearch = '<select id="searchField" class="input-medium">'+
			'<option value="">--Field--</option>'+
			'<option value="1">id</option>'+
			'<option value="2">title</option>'+
		      '</select>';
    $('#data_filter').html('<div style="float:right; visibility:hidden; ">'+htmlSearch+'&nbsp; <input class="input-medium" type="text" id="searchText" /><a class="btn" id="searchButton" >Search</a></div>');

function check(){
		var link = new Array();
		var checkvalue = new Array();
		link = document.getElementsByName('check');
		var j=0;
	    for(var i=0, n=link.length;i<n;i++) {
			if (link[i].checked == true){
				checkvalue[j]=link[i].value;
				j++;
			}
		}
	    if(j <1){
	    alert ('Please check the option you want to insert!!');}
	    else if(j == 1){
	    
	    $.fancybox.close();
	    document.getElementById("MenuutamaForm_link").value='layanan/default/index/i/'+checkvalue;
		}
		else{
		    alert ('Please check only one project do you want to insert!!');}
	}

</script>
