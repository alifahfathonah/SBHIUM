<?php

class LaporanController extends Controller
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
	
	public function actionLaporan_penjualan()
	{
		$this->layout = 'admin';
            if(isset($_POST['submit'])){
                $filterDari = DateTime::createFromFormat('d/m/Y',@$_POST['dari']);
                $filterKe = DateTime::createFromFormat('d/m/Y',@$_POST['ke']);
                $dari = $filterDari->format('Y-m-d');
                $ke = $filterKe->format('Y-m-d');
            }else{
                $new = new DateTime();
                $dari = $new->format('Y-m-01');
                $ke = $new->format('Y-m-d');
            }
            $criteriaBarang = new CDbCriteria;
            $criteriaBarang->select = '*';
            $dataBarang = Barang::model()->findAll($criteriaBarang);

            $model = new Penjualan;
            $criteria = new CDbCriteria;
            $criteria->select = '*';
            if(isset($_POST['barang']) && $_POST['barang']!==''){
                $criteria->condition = "id_barang=:id_barang";
                $criteria->params = array(':id_barang'=>@$_POST['barang']);
            }
            $criteria->addBetweenCondition('tanggal',$dari,$ke,'AND');
            $data = $model::model()->findAll($criteria);

            /*data total Penjualan*/
            $criteriaTotal = new CDbCriteria;
            $criteriaTotal->select = 'SUM(laba) AS laba';
            if(isset($_POST['barang']) && $_POST['barang']!==''){
                $criteriaTotal->condition = "id_barang=:id_barang";
                $criteriaTotal->params = array(':id_barang'=>@$_POST['barang']);
            }
            $criteriaTotal->addBetweenCondition('tanggal',$dari,$ke,'AND');
            $dataTotal = $model::model()->find($criteriaTotal);

		$this->render('laporan_penjualan',array('data'=>$data,'dataBarang'=>$dataBarang,'dataTotal'=>$dataTotal));
	}

    public function actionLaporan_pengeluaran()
    {
        $this->layout = 'admin';
            if(isset($_POST['submit'])){
                $filterDari = DateTime::createFromFormat('d/m/Y',@$_POST['dari']);
                $filterKe = DateTime::createFromFormat('d/m/Y',@$_POST['ke']);
                $dari = $filterDari->format('Y-m-d');
                $ke = $filterKe->format('Y-m-d');
            }else{
                $new = new DateTime();
                $dari = $new->format('Y-m-01');
                $ke = $new->format('Y-m-d');
            }
            $model = new Pengeluaran;
            $criteria = new CDbCriteria;
            $criteria->select = '*';
            if(isset($_POST['nama']) && $_POST['nama']!==''){
                $criteria->addSearchCondition('nama',@$_POST['nama'], true, 'AND');
            }
            $criteria->addBetweenCondition('tanggal',$dari,$ke,'AND');
            $data = $model::model()->findAll($criteria);

            /*data total Pengeluaran*/
            $criteriaTotal = new CDbCriteria;
            $criteriaTotal->select = 'SUM(jumlah) AS jumlah';
            if(isset($_POST['nama']) && $_POST['nama']!==''){
                $criteriaTotal->addSearchCondition('nama',@$_POST['nama'], true, 'AND');
            }
            $criteriaTotal->addBetweenCondition('tanggal',$dari,$ke,'AND');
            $dataTotal = $model::model()->find($criteriaTotal);

        $this->render('laporan_pengeluaran',array('data'=>$data,'dataTotal'=>$dataTotal));
    }

    public function actionLaporan_slot()
    {
        $this->layout = 'admin';
            /*tanggal pertama investasi*/
            $firstslot = Slot::model()->find(array('select'=>'*,min(id_slot) AS id_slot'));
            $firstActive_dateSlot = date('Y-m-d',strtotime($firstslot->active_date));
            /*tanggal pertama investasi*/
            if(isset($_POST['submit'])){
                $paraminput_date = DateTime::createFromFormat('d/m/Y',@$_POST['input_date']);
                $paramainput_date_sd = DateTime::createFromFormat('d/m/Y',@$_POST['input_date_sd']);
                $input_date = $paraminput_date->format('Y-m-d');
                $input_date_sd = $paramainput_date_sd->format('Y-m-d');
            }else{
                $new = new DateTime();
                $input_date = $new->format('Y-m-d');
                $input_date_sd = $firstActive_dateSlot;
            }
            /*data investor yang sudah investasi*/
            $model = new Slot();
            $criteriaInvestor = new CDbCriteria;
            $criteriaInvestor->select = '*';
            $criteriaInvestor->with = array('tUserAccount'=>array('select'=>'tUserAccount.Fullname',
                                                         'joinType'=>'INNER JOIN'));
            $criteriaInvestor->group = 't.userid';
            $criteriaInvestor->together = true;
            $dataInvestor = $model::model()->findAll($criteriaInvestor);
            /*data investor yang sudah investasi*/

            /*data Slot*/
            $criteria = new CDbCriteria;
            $criteria->select = '*';
            $criteria->with = array('tUserAccount'=>array('select'=>'tUserAccount.Fullname',
                                                         'joinType'=>'INNER JOIN'));
            if(isset($_POST['investor']) && $_POST['investor']!==''){
                $criteria->addSearchCondition('t.userid',@$_POST['investor'], true, 'AND');
            }
            if(isset($_POST['input_date']) && $_POST['input_date']!==''){
                $criteria->addBetweenCondition('input_date',$input_date,$input_date_sd,'AND');
            }
            $criteria->order = 'id_slot DESC';
            $data = $model::model()->findAll($criteria);
            /*data Slot*/

        $this->render('laporan_slot',array('data'=>$data,'dataInvestor'=>$dataInvestor,'firstActive_dateSlot'=>$firstActive_dateSlot));
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
            $header = '<link rel="stylesheet" type="text/css" href="'.Yii::app()->theme->baseUrl.'/css/custom.css'.'" />
                       <link href="'.Yii::app()->theme->baseUrl.'/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
                       <link href="'.Yii::app()->theme->baseUrl.'/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
                    <link href="'.Yii::app()->theme->baseUrl.'/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">';   

            $mpdf->WriteHTML($header.$html);
            $mpdf->Output('E-Report - tsurayya_store.pdf', 'I');
            exit;
        }
        
        if($type=="excel"){
            $file="Laporan Penjualan Investor.xls";
            header("Content-type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=$file");
            echo $html;
        }
    }
}