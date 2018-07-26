<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3>Laporan <small>Pengeluaran</small></h3>
    </div>
  </div>

  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Laporan <small>Laporan Pengeluaran</small></h2>
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
        <div class="x_content">

          <section class="content invoice" id="printArea">
            <!-- title row -->
            <div class="row">
              <div class="col-xs-12 invoice-header">
                <h1>
                    <i class="fa fa-globe"></i>
                </h1>
              </div>
              <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info removePdf">
              <form class="form-horizontal form-label-left" method="post">
              <div class="col-sm-8 invoice-col">
                <div class="form-group">
                  <label class="control-label col-md-2 col-sm-2 col-xs-2">Tanggal</label>
                  <div class="col-md-4 col-sm-4 col-xs-4">
                    <input type="text" class="form-control" name="dari" id="dari" value="<?= isset($_POST['dari'])?$_POST['dari']:date('d/m/Y',strtotime(date("Y-m-01")))?>">
                    <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
                  </div>
                  <label class="control-label col-md-1 col-sm-1 col-xs-1">s/d</label>
                  <div class="col-md-4 col-sm-4 col-xs-4">
                    <input type="text" class="form-control" name="ke" id="ke" value="<?= isset($_POST['ke'])?$_POST['ke']:date('d/m/Y',strtotime(date("Y-m-d")))?>">
                    <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2 col-sm-2 col-xs-2">Nama Pengeluaran</label>
                  <div class="col-md-4 col-sm-4 col-xs-4">
                  <input type="text" class="form-control" name="nama" id="nama" value="<?= isset($_POST['nama'])?$_POST['nama']:''; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <div class="control-label col-md-2 col-sm-2 col-xs-2"></div>
                  <div class="col-md-4 col-sm-4 col-xs-4">
                    <input type="submit" class="btn btn-primary" value="Submit" name="submit" />
                  </div>
                </div>
              </div>
              </form>
              <div id="eror" class="alert alert-danger" style="display:none"></div>
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
              <div class="col-xs-12 table">
                <p class="lead">Data Pengeluaran</p>
                <table class="table table-striped table-bordered dt-responsive nowrap">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th>Nama Pengeluaran</th>
                      <th>Jumlah</th>
                      <th>Keterangan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(!empty($data)):?>
                      <?php foreach ($data as $row):?>
                        <tr>
                          <td><?= date("d/m/Y", strtotime(@$row->tanggal));?></td>
                          <td><?= @$row->nama;?></td>
                          <td><?= 'Rp. '.number_format(@$row->jumlah,0,'.',',');?></td>
                          <td><?= @$row->keterangan;?></td>
                        </tr>
                      <?php endforeach;?>
                    <?php else:?>
                      <tr>
                        <td colspan="5">Maaf Tidak di temukan data pada bulan ini</td>
                      </tr>
                    <?php endif;?>
                  </tbody>
                </table>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
              <!-- accepted payments column -->
              <div class="col-xs-6">
                <p class="lead">Terima Kasih</p>
                <!-- <img src="images/visa.png" alt="Visa">
                <img src="images/mastercard.png" alt="Mastercard">
                <img src="images/american-express.png" alt="American Express">
                <img src="images/paypal2.png" alt="Paypal"> -->
                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                  <!-- Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra. -->
                </p>
              </div>
              <!-- /.col -->
              <div class="col-xs-6">
                <div class="table-responsive">
                  <table class="table">
                    <tbody>
                      <tr>
                        <th>Total Pengeluaran:</th>
                        <td><?= 'Rp. '.number_format(@$dataTotal->jumlah,0,'.',',');?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

          </section>
            <form method="post" id="frmReportContent" target="_blank" action="">
              <input type="hidden" value="" id="html"  name="html" />
            </form>
            <!-- this row will not appear when printing -->
            <div class="row no-print">
              <div class="col-xs-12">
                <button class="btn btn-default" onclick="printMe();"><i class="fa fa-print"></i> Print</button>
                <button class="btn btn-success pull-right" id="saveExcel"><i class="fa fa-credit-card"></i> Generate Exel</button>
                <button class="btn btn-primary pull-right" id="savePdf" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $('#dari,#ke').daterangepicker({
      singleDatePicker: true,
      calender_style: "picker_4",
      format: 'DD/MM/YYYY',
    }, function(start, end, label) {
      console.log(start.toISOString(), end.toISOString(), label);
    });

  function printMe() {    
    var printContents = document.getElementById('printArea').innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
  }

  $('#savePdf').click(function(e){
    e.preventDefault();
    $('.removePdf').remove();
    $('#html').val($('#printArea').html());
    $('#frmReportContent').attr('action','<?= Yii::app()->baseUrl.'/admin/report/laporan/download/type/pdf' ?>').submit();
    setTimeout(function() {/*Delay Reload Unremove .removePdf*/
      location.reload();
    },100);
  })
    
  $('#saveExcel').click(function(e){
    e.preventDefault();
    $('.removePdf').remove();
    $('#html').val($('#printArea').html());
    $('#frmReportContent').attr('action','<?= Yii::app()->baseUrl.'/admin/report/laporan/download/type/excel' ?>').submit();
    setTimeout(function() {/*Delay Reload Unremove .removePdf*/
      location.reload();
    },100);
  })
</script>
<style>
.ui-datepicker-calendar {
    display: none;
    }
</style>