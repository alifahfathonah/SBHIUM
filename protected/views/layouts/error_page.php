 
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
      <div class="navbar" style="margin-top: 30px;">
		
		<div class="navbar-inner">
			<div id="smoothmenu1" class="ddsmoothmenu" style="margin-left: -21px; margin-top: 27px;" >
			<ul>
			<li><a href="<?= $this->createUrl('/dashboard/default/') ?>">Dashboard</a></li>
			<li><a href="#">Transaction</a>
			  <ul>
			  <li><a href="<?= $this->createUrl('/sof/sof/cash_transaction_list') ?>">Cash Transaction</a></li>
			  <li><a href="<?= $this->createUrl('/sof/sof/borrowing_transaction_list') ?>">Borrowing Transaction</a></li>
			  <li><a href="<?= $this->createUrl('/sof/sof/sukuk_list') ?>">Sukuk Transaction</a></li>
			  </ul>
			</li>
			<li><a href="<?= $this->createUrl('/sof/sof/interest_coupon_payment') ?>">Interest/Cuopon Payment</a></li>
			<li><a href="<?= $this->createUrl('/sof/sof/interest_coupon') ?>">Principal/Sukuk Mature</a></li>
			<li><a href="#">Utility</a>
			  <ul>
			  <li><a href="<?= $this->createUrl('/sof/sof/generate') ?>">Generate to txt file</a></li>
			  </ul>
			</li>
			<li><a href="#">Master</a>
			  <ul>
			  <li><a href="<?= $this->createUrl('/master/source_of_fund/counter_party_list') ?>">Lender</a></li>
			  <li><a href="<?= $this->createUrl('/master/source_of_fund/sukuk_list_master') ?>">Setup Sukuk</a></li>
			  <li><a href="<?= $this->createUrl('/master/source_of_fund/investors_list') ?>">Investors</a></li>
			  <li><a href="<?= $this->createUrl('/master/source_of_fund/bank_list') ?>">Bank</a></li>
			  <li><a href="<?= $this->createUrl('/master/source_of_fund/currency_list') ?>">Currency</a></li>
			  </ul>
			<li ><a href="#" >Report</a>
			  <ul>
			  <li><a href="#">Jadual Bayaran Faedah Report</a></li>
			  <li><a href="#">Terima Peruntukan Report</a></li>
			  <li><a href="#">Maklumat Mengenai Keseluruhan Pinjaman Report</a></li>
			  <li><a href="#">Ringkasan Pinjaman Dana PTPTN Report</a></li>
			  <li><a href="#">Borang Sukuan KeEMPAT Report</a></li>
			  <li><a href="#">Aliran Tunai Dana Pinjaman Report</a>
				<ul>
					<li><a href="#">RMK Aliran Tunai</a></li>
					<li><a href="#">Ringkasan Aliran Tunai</a></li>
					<li><a href="#">Ringkasan dana</a></li>
					<li><a href="#">Kosdana2012</a></li>
					<li><a href="#">Analisa Ringkasan</a></li>
					<li><a href="#">SENARIO_2030</a></li>
					<li><a href="#">SENARIO</a></li>
					<li><a href="#">Kosadancomit</a></li>
				</ul>
			  </li>
			  <li><a href="#">Unjuran KWP Report</a>
				<ul>
					<li><a href="#">Sen 1 SKT 2013</a></li>
				</ul>
			  </li>
			  <li><a href="#">Optional Report</a>
				<ul>
					<li><a href="#">Cash Projection</a></li>
					<li><a href="#">Coupon Payment</a></li>
					<li><a href="#">List of Investors</a></li>
					<li><a href="#">Borrowing </a></li>
					<li><a href="#">List of SoF</a></li>
				</ul>
			  </li>
			  </ul>
			</li>
			</ul>
		</div>
		  <div class="container">
			<ul class="nav pull-right" style="margin-top: -13px; margin-right: -28px" >
			  <li class="dropdown">
			  <a href="#"  class="dropdown-toggle" data-toggle="dropdown"><span class="badge badge-important">3</span><span><i class="icon-envelope"></i></span></a>
			  <ul class="dropdown-menu">
				  <li><a href="#">Mail from applicant1</a></li>
				  <li><a href="#">Mail from applicant2</a></li>
				  <li><a href="#">Mail from applicant3</a></li>
			  </ul>
			  </li>
			  <li class="divider-vertical" style="margin-right: 4px;"></li>
			  <li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hi, User<b class="caret"></b></a>
				  <ul class="dropdown-menu">
					  <li><a href="<?= $this->createUrl('/user_profil/profil/profil') ?>">Profile</a></li>
					  <li><a href="<?= $this->createUrl('/user_profil/profil/change_password') ?>">Change Password</a></li>                       
					  <li><a href="<?= $this->createUrl('/login/default/') ?>">Logout</a></li>
				  </ul>
			  </li>
			</ul>	      
		  </div>
		</div>
      </div><!-- /.navbar -->
		<div class="row-fluid">
			<div class="span12">
				<div class="row-fluid padded10">
					<?php echo $content; ?>
				</div>
			</div><!-- span12 -->
		
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
