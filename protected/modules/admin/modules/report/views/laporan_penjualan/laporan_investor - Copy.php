<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3>Laporan <small>Penjualan</small></h3>
    </div>
  </div>

  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Laporan <small>Laporan Penjualan Untuk Investor</small></h2>
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
                    <i class="fa fa-globe"></i> <p class="lead">Laporan Penjualan Investor periode <?= isset($_POST['tanggal'])?$_POST['tanggal']:date('F Y',strtotime(date("Y-m")))?>.</p>
                </h1>
              </div>
              <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info removePdf">
              <form class="form-horizontal form-label-left" method="post" onsubmit="return checkForm()">
              <div class="col-sm-6 invoice-col">
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-3">Bulan/Tahun</label>
                  <div class="col-md-9 col-sm-9 col-xs-9">
                    <input type="text" class="form-control" name="tanggal" id="tanggal" value="<?= isset($_POST['tanggal'])?$_POST['tanggal']:date('F Y',strtotime(date("Y-m")))?>">
                    <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
                  </div>
                </div>
              </div>
              <input type="submit" class="btn btn-primary" value="Submit" name="submit" />
              </form>
              <div id="eror" class="alert alert-danger" style="display:none"></div>
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
              <div class="col-xs-12 table">
                <p class="lead">Data Penjualan</p>
                <table class="table table-striped table-bordered dt-responsive nowrap">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th>Nama Barang</th>
                      <th>Jumlah Item</th>
                      <th>Laba</th>
                      <th>Keterangan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(!empty($data)):?>
                      <?php foreach ($data as $row):?>
                        <tr>
                          <td><?= date("d/m/Y", strtotime(@$row->tanggal));?></td>
                          <td><?= @$row->tBarang->nama_barang;?></td>
                          <td><?= @$row->jumlah;?></td>
                          <td><?= 'Rp. '.number_format(@$row->laba,0,'.',',');?></td>
                          <td><?= @$row->keterangan;?></td>
                        </tr>
                      <?php endforeach;?>
                      <tr>
                        <td colspan="2" style="text-align: right;">Total Item Terjual periode <?= isset($_POST['tanggal'])?$_POST['tanggal']:date('F Y',strtotime(date("Y-m")))?>: </td>
                        <td colspan="3" style="text-align: left;"><?= $dataTotalItem->jumlah ?></td>
                      </tr>
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
                    <?php if(!empty($dataPengeluaran)):?>
                      <?php foreach ($dataPengeluaran as $row):?>
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
              <div class="col-xs-4">
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
              <div class="col-xs-8">
                <p class="lead">Perhitungan laba periode <?= isset($_POST['tanggal'])?$_POST['tanggal']:date('F Y',strtotime(date("Y-m")))?></p>
                <div class="table-responsive">
                  <table class="table">
                    <tbody>
                      <tr>
                        <th>Total Laba Penjualan:</th>
                        <td><?= 'Rp. '.number_format(@$dataTotal,0,'.',',');?></td>
                      </tr>
                      <tr>
                        <th>Total Pengeluaran:</th>
                        <td><?= 'Rp. '.number_format(@$dataTotalPengeluaran,0,'.',',');?></td>
                      </tr>
                      <tr>
                        <th>Subtotal Laba Penjualan:</th>
                        <td><?= 'Rp. '.number_format(@$subTotalPendatan,0,'.',',');?></td>
                      </tr>
                      <tr>
                        <th>Donasi Sedekah 2.5 %:</th>
                        <td><?= 'Rp. '.number_format(@$dataPersentaseSedekah,0,'.',',');?></td>
                      </tr>
                      <tr>
                        <th>Subtotal Laba Penjualan setelah sedekah:</th>
                        <td><?= 'Rp. '.number_format(@$subTotalPendatanAkhir,0,'.',',');?></td>
                      </tr>
                      <tr>
                        <th>Persentase bagi hasil Investor (40%):</th>
                        <td><?= 'Rp. '.number_format(@$dataPersentase,0,'.',',');?></td>
                      </tr>
                      <tr>
                        <th>Total slot Investor:</th>
                        <td><?= $jumlahSlot;?> Slot</td>
                      </tr>
                      <tr>
                        <th>Keuntungan Per slot:</th>
                        <td><?= 'Rp. '.number_format(@$labaPerSlot,0,'.',',');?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </section>
          <?php if($dataPersentase ==! 0):?>
            <div class="row">
              <div class="col-md-12 col-sm-6 col-xs-12 widget_tally_box">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Keuntungan Investor berdasarkan Slot</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="col-xs-12 bg-white progress_summary">
                    <?php if(Yii::app()->user->getState('role')==1): ?><!-- Untuk Admin lihat semua -->
                      <?php foreach ($dataInvestor as $investor):?>
                          <?php 
                            $labaInvestor = $investor->slot * $labaPerSlot;
                            $labaInvestorPercent = $labaInvestor/$dataPersentase*100;
                          ?>
                            <div class="row">
                              <div class="progress_title">
                                <span class="left"><?= $investor->Fullname ?></span>
                                <span class="right">Laba</span>
                                <div class="clearfix"></div>
                              </div>

                              <div class="col-xs-2">
                                <span>Slot : <?= $investor->slot ?> x <?= 'Rp. '.number_format(@$labaPerSlot,0,'.',',');?></span>
                              </div>
                              <div class="col-xs-8">
                                <div class="progress progress_sm">
                                  <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?= @$labaInvestorPercent ?>"></div>
                                </div>
                              </div>
                              <div class="col-xs-2 more_info">
                                <span><?= 'Rp. '.number_format(@$labaInvestor,0,'.',',');?></span>
                              </div>
                            </div>
                      <?php endforeach;?>
                    <?php else:?>
                      <?php foreach ($dataInvestor as $investor):?>
                          <?php 
                            $labaInvestor = $investor->slot * $labaPerSlot;
                            $labaInvestorPercent = $labaInvestor/$dataPersentase*100;
                          ?>
                          <?php if(Yii::app()->user->getState('userid')==$investor->userid):?>
                            <div class="row">
                              <div class="progress_title">
                                <span class="left"><?= $investor->Fullname ?></span>
                                <span class="right">Laba</span>
                                <div class="clearfix"></div>
                              </div>

                              <div class="col-xs-2">
                                <span>Slot : <?= $investor->slot ?> x <?= 'Rp. '.number_format(@$labaPerSlot,0,'.',',');?></span>
                              </div>
                              <div class="col-xs-8">
                                <div class="progress progress_sm">
                                  <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?= @$labaInvestorPercent ?>"></div>
                                </div>
                              </div>
                              <div class="col-xs-2 more_info">
                                <span><?= 'Rp. '.number_format(@$labaInvestor,0,'.',',');?></span>
                              </div>
                            </div>
                          <?php endif;?>
                      <?php endforeach;?>
                    <?php endif;?>

                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php endif;?><!-- validasi 0 divide -->  

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
  $('#tanggal').datepicker({
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    dateFormat: 'MM yy',
    onClose: function(dateText, inst) { 
        $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
    }
  });

  function checkForm(){
        var ret = true;
        ajaxindicatorstart('Mohon tunggu');
        if($('#tanggal').val() == ''){
            ajaxindicatorstop();
            document.getElementById("eror").innerHTML="Tanggal harus diisi";
            $("#eror").show().delay(5000).fadeOut();
            ret = false;
        }
        return ret;
    }

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
    $('#frmReportContent').attr('action','<?= Yii::app()->baseUrl.'/admin/report/laporan_penjualan/download/type/pdf' ?>').submit();
    setTimeout(function() {/*Delay Reload Unremove .removePdf*/
      location.reload();
    },100);
  })
    
  $('#saveExcel').click(function(e){
    e.preventDefault();
    $('.removePdf').remove();
    $('#html').val($('#printArea').html());
    $('#frmReportContent').attr('action','<?= Yii::app()->baseUrl.'/admin/report/laporan_penjualan/download/type/excel' ?>').submit();
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