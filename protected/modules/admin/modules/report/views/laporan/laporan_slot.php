<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3>Laporan <small>Slot</small></h3>
    </div>
  </div>

  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Laporan <small>Laporan Slot</small></h2>
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
                  <label class="control-label col-md-2 col-sm-2 col-xs-2">Nama Investor</label>
                  <div class="col-md-4 col-sm-4 col-xs-4">
                  <select class="form-control col-md-2 col-xs-2" name="investor" id="investor">
                      <option value="">--Semua Investor--</option>
                      <?php
                          $toLoop = $dataInvestor;
                          $selectedType = isset($_POST['investor'])?$_POST['investor']:'-';
                          foreach($toLoop as $investor):
                              $selected = $investor->tUserAccount->userid==$selectedType?'selected="selected"':'';
                      ?>
                              <option <?= $selected ?> value="<?= $investor->tUserAccount->userid ?>"><?= $investor->tUserAccount->Fullname ?></option>
                      <?php endforeach;?>
                  </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2 col-sm-2 col-xs-2">Tanggal Input</label>
                  <div class="col-md-4 col-sm-4 col-xs-4">
                    <input type="text" class="form-control" name="input_date" id="input_date" value="<?= isset($_POST['input_date'])?$_POST['input_date']:date('d/m/Y',strtotime($firstActive_dateSlot))?>">
                    <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
                  </div>
                  <label class="control-label col-md-1 col-sm-1 col-xs-1">s/d</label>
                  <div class="col-md-4 col-sm-4 col-xs-4">
                    <input type="text" class="form-control" name="input_date_sd" id="input_date_sd" value="<?= isset($_POST['input_date_sd'])?$_POST['input_date_sd']:date('d/m/Y',strtotime(date("Y-m-d")))?>">
                    <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
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
                      <th>Nama Investor</th>
                      <th>Tanggal Input</th>
                      <th>Tanggal Active</th>
                      <th>Debit</th>
                      <th>Kredit</th>
                      <th>Slot Akhir</th>
                      <th>Keterangan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(!empty($data)):?>
                      <?php foreach ($data as $row):?>
                        <tr>
                          <td><?= $row->tUserAccount->Fullname ?></td>
                          <td><?= date('d/m/Y',strtotime($row->input_date)) ?></td>
                          <td><?= date('d/m/Y',strtotime($row->active_date)) ?></td>
                          <td><?= $row->debit ?></td>
                          <td><?= $row->kredit ?></td>
                          <td><?= $row->slot_akhir ?></td>
                          <td><?= $row->keterangan ?></td>
                        </tr>
                      <?php endforeach;?>
                    <?php else:?>
                      <tr>
                        <td colspan="7">Maaf Tidak di temukan data pada bulan ini</td>
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
                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                </p>
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
  $('#input_date,#input_date_sd').daterangepicker({
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