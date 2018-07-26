<?php

class BarangController extends Controller
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
		if (!Yii::app()->getRequest()->getIsAjaxRequest()) {
			$model = new BarangForm;
			if (isset($_POST['BarangForm'])){
				$model->attributes = $_POST['BarangForm'];
				if ($model->validate()){

				}
			}
			$this->render('index',array('model'=>$model));
			return;
		} else {
			$start = isset($_POST['iDisplayStart'])?$_POST['iDisplayStart']:0;
			$length = isset($_POST['iDisplayLength'])?$_POST['iDisplayLength']:10;
			$useDateBetween = false;
			
			//Sort by column
			$columns = explode(',',$_POST['sColumns']);
			$orderBy = $columns[$_POST['iSortCol_0']].' '.$_POST['sSortDir_0'];
			
			//search
			$filterBy = $filterString = null;
			foreach($columns as $key=>$col){			
				if($_POST['sSearch_'.$key]!=''){
					$filterBy = $col;
					$filterString = $_POST['sSearch_'.$key];
				}
			}
			$page = ($start/$length)+1;

			$model = new Barang();
			$criteria = new CDbCriteria;
			$criteria->select = '*';
			$criteria->together = true;
			$criteria->addSearchCondition($filterBy,$filterString, true, 'AND');
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
			$class = Yii::app()->user->getState('role')!=1?'disabled':'';
			$urledit = Yii::app()->user->getState('role')!=1?'#':$this->createUrl('/admin/barang/edit/i/'.@$row->id_barang);
			$urldelete = Yii::app()->user->getState('role')!=1?'#':$this->createUrl('/admin/barang/delete/i/'.@$row->id_barang);
				
			$action = '<a class="btn btn-xs btn-warning '.$class.'" href="'.$urledit.'">
                                <i class="glyphicon glyphicon-edit icon-white"></i>
                            </a>
                            <a id="deleterow" class="btn btn-xs btn-danger '.$class.'" href="'.$urldelete.'">
                                <i class="glyphicon glyphicon-trash icon-white"></i>
                            </a>';
			$record[] = 
				array(
					htmlentities(@$row->kode_barang),
					htmlentities(@$row->nama_barang),
					htmlentities(@$row->keterangan),
					$action
				);		    
			}
			$output = array_merge($summary,array('aaData'=>$record));
			echo html_entity_decode(json_encode($output,true));
			Yii::app()->end();
	    }
}

	public function actionAdd()
	{
		if(Yii::app()->user->getState('role')!=1){
			$this->redirect(Yii::app()->createUrl('site/forbidden'));
		}
		$this->layout = 'admin';
		$model = new BarangForm;
		if(isset($_POST['BarangForm'])){
			$model->attributes = $_POST['BarangForm'];
			if($model->validate()){
				if($model->save())
                {
                	$this->redirect(Yii::app()->createUrl('admin/barang'));
                	Yii::app()->user->setFlash('Succes','Your data has Been saved');
            	}else{
            		Yii::app()->user->setFlash('Error','Error when saving data');
            	}
			}else{
				Yii::app()->user->setFlash('Error','Error when validating');
			}		
		}
		$model->saveType = 'add';
		$this->render('add',array('model'=>$model));
	}

	public function actionEdit(){
		if(Yii::app()->user->getState('role')!=1){
			$this->redirect(Yii::app()->createUrl('site/forbidden'));
		}
		$this->layout = 'admin';
		$model = new BarangForm;
		if(isset($_POST['BarangForm'])){
		    $model->attributes = $_POST['BarangForm'];
		    if($model->validate()){
				if($model->save())
                {
                	$this->redirect(Yii::app()->createUrl('admin/barang'));
                	Yii::app()->user->setFlash('Succes','Your data has Been saved');
            	}else{
            		Yii::app()->user->setFlash('Error','Error when saving data');
            	}
		    }else{
		    	Yii::app()->user->setFlash('Error','Error when validating');
			}
		}		
		$model->editcontent($_GET['i']);			
		$this->render('add',array('model'=>$model));
	}

	public function actionDelete(){
		if(Yii::app()->user->getState('role')!=1){
			$this->redirect(Yii::app()->createUrl('site/forbidden'));
		}
		$i = $_GET['i'];
		$criteria = new CDbCriteria;
		$criteria->addSearchCondition('id_barang',$i,true,'=');
		$data = Barang::model()->find($criteria);
		if($data->delete()) {
           echo "YES";
        } else {
           echo "NO";
        }		
	}	
}