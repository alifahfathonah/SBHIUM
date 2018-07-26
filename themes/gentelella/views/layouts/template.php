
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>MNC Asset Management</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<!-- styles -->
		<link href="<?= Yii::app()->theme->baseUrl ?>/manag/css/bootstrap.css" rel="stylesheet">
		<link href="<?= Yii::app()->theme->baseUrl ?>/manag/css/bootstrap-responsive.css" rel="stylesheet">
		<link href="<?= Yii::app()->theme->baseUrl ?>/manag/css/base.css" rel="stylesheet">
		<link href="<?= Yii::app()->theme->baseUrl ?>/manag/css/flexslider.css" rel="stylesheet">
		<link href="<?= Yii::app()->theme->baseUrl ?>/manag/css/prettyPhoto.css" rel="stylesheet">
		<link href="<?= Yii::app()->theme->baseUrl ?>/manag/css/style.css" rel="stylesheet">
		
		<!-- font awesome -->
        <link href="<?= Yii::app()->theme->baseUrl ?>/manag/css/font-awesome.min.css" rel="stylesheet" type="text/css" media="screen">

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- Fav and touch icons -->
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.html">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.html">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.html">
		<link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.html">
		<!-- <link rel="shortcut icon" href="ico/favicon.html"> -->
	</head>

  <body>

		<!-- Style selector -->
		<div id="config_holder">
			<div id="menu_config">
				<div class="config_slider"><i class="icon_setting"></i></div>
				<div class="config_style_text">Layout Options</div>
				<ul>

					<li class="config_select">Select type</li>
					<li class="switch_style selectedss" data-size="boxlayout">Wide</li>
					<li class="switch_style " data-size="">Boxed</li>

				</ul>
			</div>
		</div>
		
		
<!-- Image Back ground and pattern Back ground  -->
   
      <div id="pattern_bg"></div> 
    <!--   <img src="<?= Yii::app()->theme->baseUrl ?>/images/large/bg6.jpg" alt="" id="background" /> -->


<!-- Main header -->
<div id="main_wrapper">
	<div class="main_wrapper_inner">
         
	  <div class="header_top_first">
		<div class="container">
		 <div class="row">
		  <div class="span12">
	    	<div class="header_top_inner">	
         		<div class ="toad_wrapper">					 
					<div class="align_left logo"><a href="#"><img src="<?= Yii::app()->theme->baseUrl ?>/manag/images/mncam.png" alt="" /></a></div>
					<span class="clear"></span> 	
				</div>
                <!-- <div class ="text_info align_right">
					<div class="contact_head">
						<?php $contact = Contact::model()->find(); ?>
						<div class="head_tele_text"><span class="tele_text_1"><?= substr($contact->telephone, 0,6) ?></span><?= substr($contact->telephone, 6) ?></div>
						<div class="social_wrapper">  
								<a href="#"><img src="<?= Yii::app()->theme->baseUrl ?>/manag/images/facebook.png" alt="Twitter"/></a>
								<a href="#"><img src="<?= Yii::app()->theme->baseUrl ?>/manag/images/twitter.png" alt=""/></a>
	                            <a href="#"><img src="<?= Yii::app()->theme->baseUrl ?>/manag/images/rss.png" alt=""/></a>							
			            </div>
	                   <span class="clear"></span>					
	                </div>				    
					<div class="head_text_2">Hubuni kami 24/7</div>
			    </div> -->
				<div class="clear"></div> 	
			</div>
		 </div>	
         </div>		 
        </div>  	
      </div>
	  
	  <div class="header_top_second">

        <div class="container header_top_second_inner">
		 <div class="row">
		   <div class="span12">
     <!-- Header -->
			     <div class="header_top_inner1">
				 <!-- begin navigation -->
					 <?php $this->widget('application.widgets.logic.MenuPrimary',array()); ?>		
				 <!-- end navigation -->
			     </div>
                
                <form>
					<fieldset class="search-form">
						<?php if ((isset($_GET['sc'])) && (!empty($_GET['sc']))): ?>
						<input class="search" type="text" placeholder="Cari..." id="searchField" value="<?= $_GET['sc'] ?>">
						<?php else: ?>
						<input class="search" type="text" placeholder="Cari..." id="searchField">
						<?php endif;?>
						<div id="searchButton" class="search-button"></div>
					</fieldset>
				</form>
			</div>
		   </div>
        </div>
       <div class="clear"></div>
     </div>


	<!-- Content -->	   
     <?php echo $content; ?>
    <!-- End Content --> 
	
	
  	<!-- Footer -->
          <!-- Sub footer -->
		
		<div id="subfooter_wrapper">
		   <div class="container">
		    <div class="row">
    	      <div class="subfooter">
        	    <div class="span6 power_bt">
        	    <?php $contact = Contact::model()->find();?>
			     &#169; <?= $contact->copyright; ?>
			    </div>
               <div class="span6 power_right">
			      <div class="footer_nav">
					<a href="#">Beranda</a>&nbsp; &nbsp; &nbsp;
					<!-- <a href="#">About us</a>&nbsp; &nbsp; &nbsp; -->
					<a href="#">Kabar & Berita</a>&nbsp; &nbsp; &nbsp;
					<a href="#">Kontak</a>
			      </div>				  
               </div>
              </div>
			</div>
		   </div>
        </div> <!-- End Sub footer -->
		
	</div> <!-- End main_wrapper_inner -->	   
</div> <!-- End main_wrapper -->	
	
	
<!-- jquery -->
<script src="<?= Yii::app()->theme->baseUrl ?>/manag/js/jquery-1.8.3.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/manag/js/bootstrap.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/manag/js/jquery.carouFredSel-6.1.0-packed.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/manag/js/jquery.tipsy.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/manag/js/jquery.easing.1.3.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/manag/js/jquery.flexslider-min.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/manag/js/superfish.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/manag/js/jquery.color.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/manag/js/custom.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/manag/js/jquery.appear.min.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/manag/js/jquery.countto.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/manag/js/jquery.cycle.all.js"  type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/manag/js/modernizr.custom.js"  type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/manag/js/jquery.fitvids.js"  type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/manag/js/jquery.ui.totop.js"  type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/manag/js/jquery.prettyPhoto.js"  type="text/javascript"></script>

<!--<script src="http://maps.googleapis.com/maps/api/js?sensor=false" type="text/javascript"></script>-->
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDqcJFBqcviCuBZsjL_jr9lzJipNPgfbmY" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/manag/js/gmap3.js" type="text/javascript" ></script> 
<script type="text/javascript">
      $(function(){
        $('#googlemap').gmap3({
          marker:{
            address: "Jalan Kebon Sirih, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta"  // Your Adress Here
          },
          map:{
            options:{
			  zoom: 16,
			  mapTypeId: google.maps.MapTypeId.ROADMAP
            }
          }
        });
      });

 	$('#searchField').keypress(function (e) {
	 	var key = e.which;
	 	if(key == 13)  // the enter key code
	  	{
		  if ($('#searchField').val()==''){

		     alert('Isi kata pencarian');
		         return false; 
		     }
	        e.preventDefault();
			var searchText;
			searchText = $('#searchField').val();
			window.location = "<?= Yii::app()->baseUrl ?>" + '/news/default/search/sc/' + searchText;
	  	}
	});
</script>
<style type="text/css">
	.header_top_first{
		background-color: #fff;
		height: auto !important;
	}
	.logo {
	    padding: 8px 0px 1px 0px !important;
	}
</style>

<!-- google webfont font replacement  -->
<!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,700,700italic,300,300italic' rel='stylesheet' type='text/css'> -->

	</body>
</html>
