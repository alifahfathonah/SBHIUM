<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tsurayya Hijab | </title>

    <!-- Bootstrap -->
    <link href="<?= Yii::app()->theme->baseUrl ?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= Yii::app()->theme->baseUrl ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?= Yii::app()->theme->baseUrl ?>/vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- Datatables -->
    <link href="<?= Yii::app()->theme->baseUrl ?>/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?= Yii::app()->theme->baseUrl ?>/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?= Yii::app()->theme->baseUrl ?>/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?= Yii::app()->theme->baseUrl ?>/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?= Yii::app()->theme->baseUrl ?>/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="<?= Yii::app()->theme->baseUrl ?>/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?= Yii::app()->theme->baseUrl ?>/css/custom.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= Yii::app()->theme->baseUrl; ?>/css/fancybox/jquery.fancybox.css?v=2.1.4" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?= Yii::app()->theme->baseUrl; ?>/vendors/jquery-ui.custom/jquery-ui.min.css" media="screen" />
    
    <!-- Number Fromat js -->
    <script type="text/javascript" src="<?= Yii::app()->baseUrl ?>/script/number_format.js"></script>
    <!-- jQuery -->
    <script src="<?= Yii::app()->theme->baseUrl; ?>/vendors/jquery/dist/jquery.min.js"></script>
    <script src="<?= Yii::app()->theme->baseUrl; ?>/vendors/jquery-ui.custom/jquery-ui.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?= Yii::app()->theme->baseUrl ?>/js/moment/moment.min.js"></script>
    <script src="<?= Yii::app()->theme->baseUrl ?>/js/datepicker/daterangepicker.js"></script>
    <!-- Datatables -->
    <script src="<?= Yii::app()->theme->baseUrl ?>/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= Yii::app()->theme->baseUrl ?>/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?= Yii::app()->theme->baseUrl ?>/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= Yii::app()->theme->baseUrl ?>/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?= Yii::app()->theme->baseUrl ?>/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?= Yii::app()->theme->baseUrl ?>/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= Yii::app()->theme->baseUrl ?>/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?= Yii::app()->theme->baseUrl ?>/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?= Yii::app()->theme->baseUrl ?>/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?= Yii::app()->theme->baseUrl ?>/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= Yii::app()->theme->baseUrl ?>/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?= Yii::app()->theme->baseUrl ?>/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?= Yii::app()->theme->baseUrl ?>/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- Highstock -->
    <script src="<?= Yii::app()->theme->baseUrl ?>/vendors/hightstock/code/highstock.js"></script>
    <script src="<?= Yii::app()->theme->baseUrl ?>/vendors/hightstock/code/modules/exporting.js"></script>
    <script src="<?= Yii::app()->theme->baseUrl ?>/vendors/hightstock/code/modules/offline-exporting.js"></script>

    <!-- Datatables Search helper -->
        <script type="text/javascript">
          function fnResetAllFilters() {
              var oSettings = oTable.fnSettings();
              for(iCol = 0; iCol < oSettings.aoPreSearchCols.length; iCol++) {
                  oSettings.aoPreSearchCols[ iCol ].sSearch = '';
              }
          }

          function applySearchInput(objFields,objSearch) {
              $('#'+objSearch).val('');
              var dataType = $('option:selected', objFields).attr('data-type');
              if (dataType=='date') {
                $('#'+objSearch).daterangepicker({
                  singleDatePicker: true,
                  calender_style: "picker_4",
                  format: "DD/MM/YYYY",
                });
              } else if (dataType=='year') {
                $('#'+objSearch).daterangepicker({
                  singleDatePicker: true,
                  calender_style: "picker_4",
                  format: "Y"
                });
              }else{
                $('#'+objSearch).daterangepicker('remove');
                $('#'+objSearch).data('daterangepicker').remove();
              }
          }

          function DT_search(){
              var searchField = $('#searchField').val();
              var searchText = $('#searchText').val();
                    fnResetAllFilters();
              oTable.fnFilter(searchText, searchField);
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
      </script>
      <!-- End Datatables Search helper -->
      <!-- Loader Overlay -->
        <script type="text/javascript">
          function ajaxindicatorstart(text)
          {
            if(jQuery('body').find('#resultLoading').attr('id') != 'resultLoading'){
            jQuery('body').append('<div id="resultLoading" style="display:none"><div><img src="<?= Yii::app()->theme->baseUrl ?>/images/ajax-loader.gif"><div>'+text+'</div></div><div class="bg"></div></div>');
            }
            
            jQuery('#resultLoading').css({
              'width':'100%',
              'height':'100%',
              'position':'fixed',
              'z-index':'10000000',
              'top':'0',
              'left':'0',
              'right':'0',
              'bottom':'0',
              'margin':'auto'
            }); 
            
            jQuery('#resultLoading .bg').css({
              'background':'#000000',
              'opacity':'0.7',
              'width':'100%',
              'height':'100%',
              'position':'absolute',
              'top':'0'
            });
            
            jQuery('#resultLoading>div:first').css({
              'width': '250px',
              'height':'75px',
              'text-align': 'center',
              'position': 'fixed',
              'top':'0',
              'left':'0',
              'right':'0',
              'bottom':'0',
              'margin':'auto',
              'font-size':'16px',
              'z-index':'10',
              'color':'#ffffff'
              
            });

              jQuery('#resultLoading .bg').height('100%');
                jQuery('#resultLoading').fadeIn(300);
              jQuery('body').css('cursor', 'wait');
          }

          function ajaxindicatorstop()
          {
              jQuery('#resultLoading .bg').height('100%');
                jQuery('#resultLoading').fadeOut(300);
              jQuery('body').css('cursor', 'default');
          }

          // jQuery(document).ajaxStart(function () {
          //     //show ajax indicator
          //   ajaxindicatorstart('loading data.. please wait..');
          // }).ajaxStop(function () {
          //   //hide ajax indicator
          //   ajaxindicatorstop();
          // });
        </script>

  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title"><i class="fa fa-archive"></i> <span>Tsurayya Hijab</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <img src="<?= Yii::app()->theme->baseUrl ?>/images/user1.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Selamat Datang,</span>
                <h2><?= Yii::app()->user->getState('Fullname') ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />
            <?php $this->widget('application.widgets.logic.MenuAdmin',array()); ?>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav class="" role="navigation">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?= Yii::app()->theme->baseUrl ?>/images/user1.png" alt=""><?php echo Yii::app()->user->getState('username') ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?= $this->createUrl('/admin/users/profile/i/'.Yii::app()->user->getState('userid')) ?>"><i class="fa fa-user pull-right"></i> Profile</a></li>
                    <li><a href="<?= $this->createUrl('/admin/users/change_password/i/'.Yii::app()->user->getState('userid')) ?>"><i class="fa fa-cog pull-right"></i>  Ganti Pasword</a></li>
                    <li><a href="<?= Yii::app()->createUrl('/login/bye')?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" style="min-height: 643px;">
        <?php echo $content; ?>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            © 2017 tsurayya_store, All right reserved
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

  </body>

    <!-- Bootstrap -->
    <script src="<?= Yii::app()->theme->baseUrl; ?>/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?= Yii::app()->theme->baseUrl; ?>/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?= Yii::app()->theme->baseUrl; ?>/vendors/nprogress/nprogress.js"></script>
    <!-- Fancybox -->
    <script type="text/javascript" src="<?= Yii::app()->theme->baseUrl; ?>/assets/fancybox/jquery.fancybox.js?v=2.1.4"></script>
    <!-- bootstrap-daterangepicker -->
    <!-- <script src="<?= Yii::app()->theme->baseUrl ?>/js/moment/moment.min.js"></script>
    <script src="<?= Yii::app()->theme->baseUrl ?>/js/datepicker/daterangepicker.js"></script> -->
    <!-- iCheck -->
    <script src="<?= Yii::app()->theme->baseUrl ?>/vendors/iCheck/icheck.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?= Yii::app()->theme->baseUrl ?>/js/custom.js"></script>
    <script src="<?= Yii::app()->theme->baseUrl ?>/vendors/jszip/dist/jszip.min.js"></script>
    <script src="<?= Yii::app()->theme->baseUrl ?>/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?= Yii::app()->theme->baseUrl ?>/vendors/pdfmake/build/vfs_fonts.js"></script>

    
</html>