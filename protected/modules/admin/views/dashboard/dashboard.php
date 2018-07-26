  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Dashboard <small></small></h3>
      </div>
    </div>
    
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12">
        <div class="x_panel">
          <div class="x_content">
              <!-- flash succes forgot password -->
              <?php if(Yii::app()->user->hasFlash('Succes')): ?>
                <div class="alert alert-info" >
                    <?php echo Yii::app()->user->getFlash('Succes'); ?>
                </div>
              <?php endif; ?>
              <!-- flash succes forgot password -->
              <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">

              <div class="dashboard_graph x_panel">
                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>Penjualan <small>Harian</small></h3>
                  </div>
                </div>
                <div class="x_content">
                  <!-- Chart -->
                  <div id="container" class="demo-container"></div>
                  <!-- Chart -->
                </div>
              </div>
              <!-- bulanan -->
              <div class="dashboard_graph x_panel">
                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>Penjualan <small>Bulanan</small></h3>
                  </div>
                </div>
                <div class="x_content">
                  <!-- Chart -->
                  <div id="container2"  class="demo-container"></div>
                  <!-- Chart -->
                </div>
              </div>

            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<script type="text/javascript">
$(function() {
    // create the chart
      window.chart = new Highcharts.StockChart({
          chart : {
                    renderTo : 'container'
                },

          rangeSelector : {
              selected : 4,
              inputDateFormat: '%Y-%m-%d',
              inputEditDateFormat: '%Y-%m-%d'
          },

          title: {
              text: 'Performa penjualan tsurayya_store total'
          },

          subtitle: {
              text: '<?= $barang ?>'
          },

          xAxis: {
              gapGridLineWidth: 0
          },

          series: [{
              name: '<?= $barang ?>',
              type: 'areaspline',
              // data: data,
              data: <?= $dataChart ?>,
              gapSize: 5,
              tooltip: {
                  valueDecimals: 2
              },
              fillColor: {
                  linearGradient: {
                      x1: 0,
                      y1: 0,
                      x2: 0,
                      y2: 1
                  },
                  stops: [
                      [0, Highcharts.getOptions().colors[0]],
                      [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                  ]
              },
              threshold: null
          }]
      }, function(chart){

          // apply the date pickers
          setTimeout(function(){
              $('input.highcharts-range-selector', $('#'+chart.options.chart.renderTo))
                  .datepicker()
          },0)
      });

      // Set the datepicker's date format
        $.datepicker.setDefaults({
            dateFormat: 'yy-mm-dd',
            onSelect: function(dateText) {
                this.onchange();
                this.onblur();
            }
        });

        /*chart bawah*/
        Highcharts.chart('container2', {
          chart: {
              type: 'column'
          },
          title: {
              text: 'Perbandingan Penjualan per bulan'
          },
          subtitle: {
              text: ' Berdasarkan Jenis Barang'
          },
          xAxis: {
              /*categories: [
                  'Jan',
                  'Feb',
                  'Mar',
                  'Apr',
                  'May',
                  'Jun',
                  'Jul',
                  'Aug',
                  'Sep',
                  'Oct',
                  'Nov',
                  'Dec'
              ],*/
              categories: <?= $bulan ?>,
              crosshair: true
          },
          yAxis: {
              min: 0,
              title: {
                  text: 'Rupiah'
              }
          },
          tooltip: {
              // headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
              // pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
              //     '<td style="padding:0"><b>{point.y:.2f}</b></td></tr>',
              // footerFormat: '</table>',
              valueDecimals: 2,
              shared: true,
              useHTML: true
          },
          plotOptions: {
              column: {
                  pointPadding: 0.2,
                  borderWidth: 0
              }
          },
          /*series: [{
              name: 'Tokyo',
              data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

          }, {
              name: 'New York',
              data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

          }, {
              name: 'London',
              data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

          }, {
              name: 'Berlin',
              data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

          }]*/
          series: <?= $dataperbulanchart ?>
      });
});
</script>