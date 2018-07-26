<?php

class UsersController extends Controller
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
		if(Yii::app()->user->getState('role')!=1){
			$this->redirect(Yii::app()->createUrl('site/forbidden'));
		}
		$this->layout = 'admin';
		if (!Yii::app()->getRequest()->getIsAjaxRequest()) {
			$model = new UsersForm;
			if (isset($_POST['UsersForm'])){
				$model->attributes = $_POST['UsersForm'];
				if ($model->validate()){

				}
			}
			$this->render('index',array('model'=>$model));
			return;
		} else {
			$start = isset($_POST['iDisplayStart'])?$_POST['iDisplayStart']:0;
			$length = isset($_POST['iDisplayLength'])?$_POST['iDisplayLength']:10;
			
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

			$model = new UserAccount();
			$criteria = new CDbCriteria;
			$criteria->select = '*';
			$criteria->with = array('tRole'=>array('select'=>'tRole.nama',
														 'joinType'=>'INNER JOIN'));
			$criteria->addNotInCondition('role', array(1));
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
			$urledit = Yii::app()->user->getState('role')!=1?'#':$this->createUrl('/admin/users/edit/i/'.@$row->userid);
			$urldelete = Yii::app()->user->getState('role')!=1?'#':$this->createUrl('/admin/users/delete/i/'.@$row->userid);
			$action = '<a class="btn btn-xs btn-warning '.$class.'" href="'.$urledit.'">
                                <i class="glyphicon glyphicon-edit icon-white"></i>
                            </a>
                            <a id="deleterow" class="btn btn-xs btn-danger '.$class.'" href="'.$urldelete.'">
                                <i class="glyphicon glyphicon-trash icon-white"></i>
                            </a>';
			$record[] = 
				array(
					htmlentities(@$row->username),
					htmlentities(@$row->email),
					htmlentities(@$row->Fullname),
					htmlentities(@$row->Phone),
					htmlentities(@$row->City),
					htmlentities(@$row->nama_bank),
					htmlentities(@$row->rek_bank),
					// htmlentities(@$row->slot),
					htmlentities(@$row->IsActive==1?'Yes':'No'),
					htmlentities(@$row->tRole->nama),
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
		$model = new UsersForm;
		$model->setscenario('add');
		if(isset($_POST['UsersForm'])){
			$model->attributes = $_POST['UsersForm'];
			if($model->validate()){
				if($model->save())
                {
                	$this->redirect(Yii::app()->createUrl('admin/users'));
                	Yii::app()->user->setFlash('Succes','Your data has Been saved');
            	}else{
            		Yii::app()->user->setFlash('Error','Error when saving data');
            	}
			}else{
				Yii::app()->user->setFlash('Error','Error when validating');
			}		
		}
		$model->saveType = 'add';
		$this->render('add_user',array('model'=>$model));
	}

	public function actionEdit(){
		// if(Yii::app()->user->getState('role')!=1){
		// 	$this->redirect(Yii::app()->createUrl('site/forbidden'));
		// }
		$this->layout = 'admin';
		$model = new UsersForm;
		$model->setscenario('edit');
		if(isset($_POST['UsersForm'])){
		    $model->attributes = $_POST['UsersForm'];
		    if($model->validate()){
				if($model->save())
                {
                	if(isset($_GET['referrer'])){
                		$this->redirect(Yii::app()->createUrl('/admin/users/profile/i/'.$_GET['i'].''));	
                	}
                	$this->redirect(Yii::app()->createUrl('admin/users'));
                	Yii::app()->user->setFlash('Succes','Your data has Been saved');
            	}else{
            		Yii::app()->user->setFlash('Error','Error when saving data');
            	}
		    }else{
		    	Yii::app()->user->setFlash('Error','Error when validating');
			}
		}		
		$model->editcontent($_GET['i']);			
		$this->render('add_user',array('model'=>$model));
	}

	public function actionDelete(){
		if(Yii::app()->user->getState('role')!=1){
			$this->redirect(Yii::app()->createUrl('site/forbidden'));
		}
		$i = $_GET['i'];
		$criteria = new CDbCriteria;
		$criteria->addSearchCondition('userid',$i,true,'=');
		$data = UserAccount::model()->find($criteria);
		if($data->delete()) {
           echo "YES";
        } else {
           echo "NO";
        }		
	}

	public function actionProfile(){
		$this->layout = 'admin';
		$criteria = new CDbCriteria;
		$criteria->addSearchCondition('userid',$_GET['i'],true,'=');
		$data = UserAccount::model()->find($criteria);

		/*Data Slot*/
		$criteriaSlot = new CDbCriteria;
		$criteriaSlot->condition = "userid=:userid";
    	$criteriaSlot->params = array(':userid'=>$data->userid);
    	$criteriaSlot->order = 'id_slot DESC';
        $dataSlot = Slot::model()->findAll($criteriaSlot);
        /*Data Slot Akhir*/
        $dataSlotAkhir = Slot::model()->find($criteriaSlot);
        /*Data Slot Akhir*/
		/*Data Slot*/
		$this->render('profile',array('data'=>$data,'dataSlot'=>$dataSlot,'dataSlotAkhir'=>$dataSlotAkhir));
	}

	public function actionChange_password(){
		$this->layout = 'admin';
		$model = new UsersForm;
		$model->setscenario('changePassword');
		if(isset($_POST['UsersForm'])){
		    $model->attributes = $_POST['UsersForm'];
		    $criteria = new CDbCriteria;
        	$criteria->addSearchCondition('userid',$_POST['UsersForm']['userid'],false,'=');
        	$data = UserAccount::model()->find($criteria);
        	if(md5($_POST['UsersForm']['Password'])==$data->Password){
			    if($model->validate()){
					if($model->saveChangePassword())
	                {
	                	Yii::app()->user->setFlash('Succes','Password Anda berhasil dirubah');
	                	$this->redirect(Yii::app()->createUrl('/admin/dashboard'));	
	            	}else{
	            		Yii::app()->clientScript->registerScript('Error', "alert('Any Erorr');");
	            	}
			    }else{
			    	Yii::app()->clientScript->registerScript('Error', "alert('Any Erorr');");
				}
        	}else{
        		Yii::app()->user->setFlash('Error','Password lama salah');
        	}

		}		
		$model->changePassword($_GET['i']);
		$this->render('change_password',array('model'=>$model));
	}
}