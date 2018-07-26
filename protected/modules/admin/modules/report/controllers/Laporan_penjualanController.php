<?php

class Laporan_penjualanController extends Controller
{
    public function filters()
    {
        return array( 'accessControl' ); 
    }
    
    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated users to access all actions
                'users'=>array('@'),
            ),
            array('deny'),
        );
    }
    
    public function actionLaporan_investor()
    {
        $this->layout = 'admin';
            if(isset($_POST['submit'])){
                $tanggal = date('Y-m',strtotime($_POST['tanggal']));
            }else{
                $tanggal = date('Y-m',strtotime(date("Y-m")));
            }
            $model = new Penjualan();
            $criteria = new CDbCriteria;
            $criteria->select = '*';
            $criteria->condition = "DATE_FORMAT(tanggal,'%Y-%m')=:tanggal";
            $criteria->params = array(':tanggal'=>$tanggal);
            $data = $model::model()->findAll($criteria);

            /*data total Penjualan*/
            $criteriaTotal = new CDbCriteria;
            $criteriaTotal->select = 'SUM(laba) AS laba';
            $criteriaTotal->condition = "DATE_FORMAT(tanggal,'%Y-%m')=:tanggal";
            $criteriaTotal->params = array(':tanggal'=>$tanggal);
            $dataTotal = $model::model()->find($criteriaTotal);

            /*data Pengeluaran*/
            $criteriaPengeluaran = new CDbCriteria;
            $criteriaPengeluaran->select = '*';
            $criteriaPengeluaran->condition = "DATE_FORMAT(tanggal,'%Y-%m')=:tanggal";
            $criteriaPengeluaran->params = array(':tanggal'=>$tanggal);
            $dataPengeluaran = Pengeluaran::model()->findAll($criteriaPengeluaran);

            /*data total Pengeluaran*/
            $criteriaTotalPengeluaran = new CDbCriteria;
            $criteriaTotalPengeluaran->select = 'SUM(jumlah) AS jumlah';
            $criteriaTotalPengeluaran->condition = "DATE_FORMAT(tanggal,'%Y-%m')=:tanggal";
            $criteriaTotalPengeluaran->params = array(':tanggal'=>$tanggal);
            $dataTotalPengeluaran = Pengeluaran::model()->find($criteriaTotalPengeluaran);

            $dataTotal = $dataTotal->laba != NULL?$dataTotal->laba:0;
            $dataTotalPengeluaran = $dataTotalPengeluaran->jumlah != NULL?$dataTotalPengeluaran->jumlah:0;

            // Data Slot Range by active_date
            // Tambah Parameter Active Date 
                $firstslot = Slot::model()->find(array('select'=>'*,min(id_slot) AS id_slot'));
                $firstActive_dateSlot = date('Y-m',strtotime($firstslot->active_date));

                $criteriaSlot = new CDbCriteria;
                $criteriaSlot->select = 'max(id_slot) AS id_slot';
                $criteriaSlot->addBetweenCondition("DATE_FORMAT(active_date,'%Y-%m')",$firstActive_dateSlot,$tanggal);
                $criteriaSlot->group = 'userid';
                $dataSlot = Slot::model()->findAll($criteriaSlot);

                $grandTotals = array();
                foreach ($dataSlot as $key_id) {
                    $grandTotals[] = Slot::model()->findByPk($key_id->id_slot);
                }
                $grandTotal = 0;
                foreach($grandTotals as $grand) {
                    $grandTotal += $grand->slot_akhir;
                }
                $jumlahSlot = $grandTotal;
            // Data Slot Range by active_date    

            if($dataTotal != 0 AND $jumlahSlot != 0){
                $subTotalPendapatan = $dataTotal - $dataTotalPengeluaran;
                /*hitung sedekah/donasi*/
                $dataPersentaseSedekah = (2.5*$subTotalPendapatan)/100;
                $subTotalPendapatanAkhir = $subTotalPendapatan - $dataPersentaseSedekah;
                /*hitung sedekah/donasi*/

                /*persentase 40%*/
                $dataPersentase = (40*$subTotalPendapatanAkhir)/100;
                /*persentase 40%*/
                
                $labaPerSlot = $dataPersentase/$jumlahSlot;
            }else{
                $subTotalPendapatan = 0;
                $dataPersentase = 0;
                $labaPerSlot = 0;
                $dataPersentaseSedekah = 0;
                $subTotalPendapatanAkhir = 0;
            }

            $dataInvestor = array();
            foreach ($dataSlot as $valmaxid) {
                $dataInvestor[] = Slot::model()->with(array('tUserAccount'=>array('select'=>'tUserAccount.Fullname',
                                                         'joinType'=>'INNER JOIN')))->find('id_slot = '.$valmaxid->id_slot.'');
            }

            /*Count Item sedekah customer*/
            $criteriaTotalitem = new CDbCriteria;
            $criteriaTotalitem->select = 'SUM(jumlah) AS jumlah';
            $criteriaTotalitem->condition = "DATE_FORMAT(tanggal,'%Y-%m')=:tanggal";
            $criteriaTotalitem->params = array(':tanggal'=>$tanggal);
            $dataTotalItem = $model::model()->find($criteriaTotalitem);
            
        $this->render('laporan_investor',array('data'=>$data,'dataTotal'=>$dataTotal,'dataPengeluaran'=>$dataPengeluaran,'dataTotalPengeluaran'=>$dataTotalPengeluaran,'subTotalPendapatan'=>$subTotalPendapatan,'dataPersentase'=>$dataPersentase,'labaPerSlot'=>$labaPerSlot,'dataInvestor'=>$dataInvestor,'jumlahSlot'=>$jumlahSlot,'dataPersentaseSedekah'=>$dataPersentaseSedekah,'subTotalPendapatanAkhir'=>$subTotalPendapatanAkhir, 'dataTotalItem'=>$dataTotalItem));
    }

    public function actionDownload(){
        $type = $_GET['type'];
        $html = $_POST['html'];
        if($type=='pdf'){           
            Yii::import('application.vendors.*');
            include('mpdf/mpdf.php');
            $mpdf=new mPDF('c');
            $mpdf->SetHeader('||E-Report - Laporan Penjualan Investor');
            $mpdf->AliasNbPages('[pagetotal]');
            $mpdf->SetFooter('Printed on {DATE j.m.Y h:i:s}|| Page {PAGENO} of [pagetotal]');
            $header = '';   

            $mpdf->WriteHTML($header.$html);
            $mpdf->Output('E-Report - tsurayya_store.pdf', 'I');
            exit;
        }
        
        if($type=="excel"){
            $file="Laporan Penjualan Investor.xls";
            header("Content-type: application/xls");
            header("Content-Disposition: attachment; filename=$file");
            echo $html;
        }
    }
}