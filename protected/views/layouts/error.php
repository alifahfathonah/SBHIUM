 
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>PTPTN - Student Loan Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<script src="<?= Yii::app()->baseUrl ?>/script/jquery.js"></script>
    <script src="<?= Yii::app()->theme->baseUrl ?>/script/bootstrap.js"></script>
    <script src="<?= Yii::app()->theme->baseUrl ?>/script/bootstrap-datepicker.js"></script>
    <script src="<?= Yii::app()->baseUrl ?>/script/jquery.dataTables.min.js"></script>
    <script src="<?= Yii::app()->baseUrl ?>/script/dataTable.ajaxReload.js"></script>
    <script src="<?= Yii::app()->baseUrl ?>/script/jquery.fnSetFilteringDelay.js"></script>
    <script src="<?= Yii::app()->baseUrl ?>/script/DT_bootstrap.js"></script>
    <script src="<?= Yii::app()->baseUrl ?>/script/lms.js"></script>
    <script type="text/javascript" src="<?= Yii::app()->baseUrl ?>/script/jquery.fancybox.js?v=2.1.4"></script>
    <script src="<?= Yii::app()->baseUrl ?>/script/select2.js"></script>
    <link rel="stylesheet" type="text/css" href="<?= Yii::app()->baseUrl ?>/css/jquery.fancybox.css?v=2.1.4" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?= Yii::app()->baseUrl ?>/css/select2/select2.css" media="screen" />
    <!-- Le styles -->
    <style type="text/css">
      body {
        padding-top: 20px;
        padding-bottom: 60px;
      }	
	  .stat-box{
		width: 130%;
	  }
      
      .row{margin-left: 0px !important}
      
      /* Custom container */
      .container {
        margin: 0 auto;
        max-width: 1000px;
      }
      .container > hr {
        margin: 60px 0;
      }

      /* Main marketing message and sign up button */
      .jumbotron {
        margin: 80px 0;
        text-align: center;
      }
      .jumbotron h1 {
        font-size: 100px;
        line-height: 1;
      }
      .jumbotron .lead {
        font-size: 24px;
        line-height: 1.25;
      }
      .jumbotron .btn {
        font-size: 21px;
        padding: 14px 24px;
      }

      /* Supporting marketing content */
      .marketing {
        margin: 60px 0;
      }
      .marketing p + h4 {
        margin-top: 28px;
      }
      #mask {position:absolute;z-index:9000;background-color:#b2b2b2;display:none;}
        #page_loading{
             position:fixed;
            width:440px;
            height:200px;
            display:none;
            z-index:9999;
            padding:20px;
            background-image: url(<?= Yii::app()->baseUrl . '/images/page_loader.gif' ?>); background-position: center center;background-repeat: no-repeat
        }
    </style>
    <link href="<?= Yii::app()->theme->baseUrl ?>/css/bootstrap.css" rel="stylesheet" media="all" />
	<link rel="stylesheet" href="<?= Yii::app()->baseUrl ?>/css/bwizard.min.css" media="all" />
    <link rel="stylesheet" href="<?= Yii::app()->baseUrl ?>/css/datepicker.css" media="all" />
	<link rel="stylesheet" href="<?= Yii::app()->baseUrl ?>/css/ddsmoothmenu.css" media="all" />
    <link rel="stylesheet" href="<?= Yii::app()->baseUrl ?>/css/ddsmoothmenu-v.css" media="all" />
     <link rel="stylesheet" href="<?= Yii::app()->baseUrl ?>/css/DT_bootstrap.css" media="all" />
	<script type="text/javascript">var baseUrl = "<?= Yii::app()->baseUrl ?>";</script>
	<script src="<?= Yii::app()->baseUrl ?>/script/ddsmoothmenu.js" media="screen"></script>
	<script type="text/javascript">	
	function fnResetAllFilters() {
        var oSettings = oTable.fnSettings();
        for(iCol = 0; iCol < oSettings.aoPreSearchCols.length; iCol++) {
            oSettings.aoPreSearchCols[ iCol ].sSearch = '';
        }
    }

    function DT_search(){
        var searchField = $('#searchField').val();
    	var searchText = $('#searchText').val();
        fnResetAllFilters();
    	oTable.fnFilter(searchText, searchField);
    }
    
    function applySearchInput(objFields,objSearch) {
	$('#'+objSearch).val('');
	var dataType = $('option:selected', objFields).attr('data-type');
	if (dataType=='date') {
	    $('#'+objSearch).datepicker({
		format: " yyyy-mm-dd",
		autoclose: true
	    });
	}else{
	    $('#'+objSearch).datepicker('remove');
	}
    }
        
    $(function(){
        $('#searchText').bind('keypress', function(e) {
            var code = (e.keyCode ? e.keyCode : e.which);
            if(code == 13) { //Enter keycode
              DT_search();
              return false;
            }
    	});
	    $('#searchButton').click(function(){
	        DT_search();
	    })
	 })

	ddsmoothmenu.init({
		mainmenuid: "smoothmenu1", //menu DIV id
		orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
		classname: 'ddsmoothmenu', //class added to menu's outer DIV
		//customtheme: ["#1c5a80", "#18374a"],
		contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
	})
	</script>
	<style type="text/css">
		.ddsmoothmenu ul li a.selected { 
		background: grey; 
		color: white;
		}
		
		
	</style>
  </head>

	<body style="background: url(<?= Yii::app()->theme->baseUrl ?>/image/paper.png)">
	<div id="page_loading"></div>
	<div id="mask"></div>
    <div class="container" style="background-color: #fff;border: 1px solid #ccc;padding: 15px 5px 0 5px">

		<div class="masthead">
        <img src="<?= Yii::app()->theme->baseUrl ?>/image/top_new.png" style="margin:0 auto;position: absolute;top: 25px" />
      	</div>
		<div class="row-fluid">
			<div class="span12" style="margin-top: 60px;">
				<div class="row-fluid padded10">
					
				</div>
			</div><!-- span12 -->
		
		</div>
		<div class="row-fluid">
			<div class="span6" style="text-align:right">
				<a href="<?= $this->createUrl('/dashboard/') ?>" class="btn btn-large btn-success" role="button" style="margin-right: -100px;">Go To Dashboard</a>
			</div>
		</div>
		<hr style="margin: 0px 0 5px 0;background: url() #ccc;height: 8px ">

		<div class="footer">
		<p>&copy; Company 2013 - PTPTN</p>
		</div>

    </div> <!-- /container -->
	
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
  </body>
</html>
