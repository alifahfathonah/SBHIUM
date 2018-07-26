<?php

class MenuController extends Controller
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
		$this->render('index');
	}

    public function actionAdd_main(){/*Add Main Menu Perent 0*/
        
        $this->layout = 'admin';
        $model = new MenuutamaForm();
        if(isset($_POST['MenuutamaForm'])){
            $model->attributes = $_POST['MenuutamaForm'];
            $model->save();
        }
        
        $model->saveType = 'add_main';
        $model->parentid = '0';
        $model->link = '#';
        $this->render('add',array('model'=>$model));
    }

    public function actionAdd(){
        
        $this->layout = 'admin';
        $model = new MenuutamaForm();
        if(isset($_POST['MenuutamaForm'])){
            // print_r($_POST['MenuutamaForm']);exit;
            $model->attributes = $_POST['MenuutamaForm'];
            $model->save();
        }
        
        $model->add();
        $this->render('add',array('model'=>$model));
    }

    public function actionEdit(){
        
        $this->layout = 'admin';
        $model = new MenuutamaForm();
        if(isset($_POST['MenuutamaForm'])){
            $model->attributes = $_POST['MenuutamaForm'];
            $model->save();
        }
        
        $model->edit();
        $this->render('add',array('model'=>$model));
    }

    public function actionBrowse()
    {
        $this->layout = ' ';

        if(isset($_POST['MenuutamaForm'])){
            $model->attributes = $_POST['MenuutamaForm'];
            $model->save();
        }
        $this->render('browse_layanan');
    }

    public function actionJson()
    {
        if (!Yii::app()->getRequest()->getIsAjaxRequest()) {
            $this->render('index',array('model'=>$data));
            return;
        } else {
            $start = isset($_POST['iDisplayStart'])?$_POST['iDisplayStart']:0;
            $length = isset($_POST['iDisplayLength'])?$_POST['iDisplayLength']:10;
            
            //Sort by column
            $columns = explode(',',$_POST['sColumns']);
            $orderBy = $columns[$_POST['iSortCol_0']].' '.$_POST['sSortDir_0'];
            
            $page = ($start/$length)+1;

            $model = new Layanan;
            $criteria = new CDbCriteria;
            $criteria->select = '*';
            
            $total = $model->count($criteria);          
            $summary = array("iTotalRecords"=>$total,"iTotalDisplayRecords"=>$total);           
            $criteria->order = $orderBy;
            if($page*$length > $total){
                $sisa = ($page * $length) - $total;
                $criteria->limit = $length - $sisa;
            }else{
                $criteria->limit = $length; 
            }
            $criteria->offset = $start; 
            $data = $model::model()->findAll($criteria);
            $record = array();
            foreach($data as $row)
            {
            $check = '<input type="radio" value="'.$row->id.'" name="check"><input type="hidden" value="'.$row->id.'" name="check2">';
            $record[] = 
                array(
                    $check,
                    htmlentities(@$row->id),
                    htmlentities(@$row->title)
                );          
            }
            $output = array_merge($summary,array('aaData'=>$record));
            echo html_entity_decode(json_encode($output,true));
            Yii::app()->end();
        }
    }

    public function actionDelete(){
            
        try{
            Menuutama::model()->deleteByPk($_POST['i']);
            $err = null;
            $success = 1;
        }catch(Exception $e){
            $success = 0;
            $err = $e->getMessage();
        }
        
        echo json_encode(array('success'=>$success,'htmlError'=>$err));
    }
}