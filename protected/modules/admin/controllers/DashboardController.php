<?php

class DashboardController extends Controller
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
    
    public function actionIndex()
    {
        $this->layout = 'admin';

        /*total*/
        $model = new Penjualan;
        $criteria = new CDbCriteria;
        $criteria->select = 'SUM(laba)AS laba,tanggal,id_barang';
        $criteria->group = 'tanggal';
        $data = $model::model()->findAll($criteria);
        foreach ($data as $nav) {
            $date = new DateTime($nav->tanggal);
            $dataChart[] = array( strtotime($date->format('Y-m-d'))*1000
                        , $nav->laba);
            $namabarang[] = $nav->tBarang->nama_barang; 
        }
        $uniquebarang = array_unique($namabarang);
        $barang = '';
        foreach ($uniquebarang as $valuebarang) {
            $barang .= $valuebarang .' + ';
        }

        $dataChart = str_replace('"',"",json_encode($dataChart));
        $barang = rtrim($barang,"+ ");
        /*total*/

        /*total perbulan*/
        /*cari bulan penjulan*/
        $bulanpenjualan = new CDbCriteria;
        $bulanpenjualan->select = 'DATE_FORMAT(tanggal,"%m") as tanggal';
        $bulanpenjualan->distinct = 'tanggal';
        $databulanpenjualan = $model::model()->findAll($bulanpenjualan);

        /*cari barang penjulan*/
        $barang2 = new CDbCriteria;
        $barang2->select = '*';
        $databarang2 = Barang::model()->findAll($barang2);

        $datalaba = array();
        foreach ($databulanpenjualan as $valuebulan) {
            foreach ($databarang2 as $valdatabarang) {
                $criteriaperbulan = new CDbCriteria;
                $criteriaperbulan->select = '*,SUM(laba) AS laba';
                $criteriaperbulan->addInCondition('DATE_FORMAT(tanggal,"%Y-%m")',array(date('Y-m',strtotime(date("Y-".$valuebulan->tanggal)))));
                $criteriaperbulan->addInCondition('id_barang',array($valdatabarang->id_barang));
                $dataperbulan = $model::model()->findAll($criteriaperbulan);
                    foreach ($dataperbulan as $keydataperbulan => $valuedataperbulan) {
                        if(isset($valuedataperbulan->tBarang->nama_barang)){
                            $datalaba[$valuedataperbulan->tBarang->nama_barang][] = (float)$valuedataperbulan->laba;
                        }
                    }
            }
                    $bulan[] = date('M-Y',strtotime(date("Y-".$valuebulan->tanggal)));
        }

        $dataperbulanchart = array();
        foreach ((array)$datalaba as $keya => $valuea) {
            $dataperbulanchart[] = array('name'=>$keya,'data'=>$valuea);
        }
        $bulan = json_encode($bulan);
        $dataperbulanchart = json_encode($dataperbulanchart);

        $this->render('dashboard',array('dataChart'=>$dataChart,'barang'=>$barang,'dataperbulanchart'=>$dataperbulanchart,'bulan'=>$bulan));
    }
}