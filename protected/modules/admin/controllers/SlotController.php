<?php

class SlotController extends Controller
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
			$model = new SlotForm;
			if (isset($_POST['SlotForm'])){
				$model->attributes = $_POST['SlotForm'];
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
				//For searching on column date
				if($filterBy=='t.input_date' OR $filterBy=='t.active_date'){
					$useDateBetween = true;
					$filterDate = DateTime::createFromFormat('d/m/Y',$filterString);
					$dateFrom = $filterDate->format('Y-m-d').' 00:00:00';
					$dateTo = $filterDate->format('Y-m-d').' 23:59:59';
				}
			}
			$page = ($start/$length)+1;

			$model = new Slot();
			$criteria = new CDbCriteria;
			$criteria->select = '*';
			$criteria->with = array('tUserAccount'=>array('select'=>'tUserAccount.Fullname',
														 'joinType'=>'INNER JOIN'));
			$criteria->together = true;
			if($useDateBetween){
				$criteria->addBetweenCondition($filterBy,$dateFrom,$dateTo,'AND');
			}
			if(!$useDateBetween){
				$criteria->addSearchCondition($filterBy,$filterString, true, 'AND');
			}
			//for grand Total
			$last_id = $model->findAll(array('select'=>'max(id_slot) AS id_slot','group'=>'userid'));
			$grandTotals = array();
			foreach ($last_id as $key_id) {
				$grandTotals[] = $model->findByPk($key_id->id_slot);
			}
			$grandTotal = 0;
			foreach($grandTotals as $grand) {
				$grandTotal += $grand->slot_akhir;
			}
			// // End grand total
			$total = $model->count($criteria);
				/*proses tambahan hanya untuk pebandingan nama di data dengan investor*/
				/*data investor*/
					$modelUserAccount = new UserAccount();
					$criteriaUserAccount = new CDbCriteria;
					$criteriaUserAccount->select = '*';
					$criteriaUserAccount->addNotInCondition('role', array(1));
					$criteriaUserAccount->together = true;
					$dataUserAccount = $modelUserAccount::model()->findAll($criteriaUserAccount);
					$recorddataUserAccount = array();
					foreach ($dataUserAccount as $valdataUserAccount) {
						$recorddataUserAccount[] = $valdataUserAccount->Fullname;
					}
				/*data investor*/
				/*proses tambahan hanya untuk pebandingan nama di data dengan investor*/
			$summary = array("iTotalRecords"=>$total,"iTotalDisplayRecords"=>$total,"grandTotal"=>$grandTotal);
			// $criteria->order = $orderBy;
			$criteria->order = 'id_slot DESC';
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
				$inputdate = date("d/m/Y", strtotime($row->input_date));	
				$activedate = date("d/m/Y", strtotime($row->active_date));
				$class = Yii::app()->user->getState('role')!=1?'disabled':'';
				$urledit = Yii::app()->user->getState('role')!=1?'#':$this->createUrl('/admin/slot/edit/i/'.@$row->id_slot);
				$urldelete = Yii::app()->user->getState('role')!=1?'#':$this->createUrl('/admin/slot/delete/i/'.@$row->id_slot);

				$action = '<a class="btn btn-xs btn-warning '.$class.'" href="'.$urledit.'">
	                                <i class="glyphicon glyphicon-edit icon-white"></i>
	                            </a>
	                            <a id="deleterow" class="btn btn-xs btn-danger '.$class.'" href="'.$urldelete.'">
	                                <i class="glyphicon glyphicon-trash icon-white"></i>
	                            </a>';
				$record[] = 
					array(
						htmlentities(@$row->tUserAccount->Fullname),
						htmlentities(@$row->debit),
						htmlentities(@$row->kredit),
						htmlentities(@$row->slot_akhir),
						htmlentities(@$inputdate),
						htmlentities(@$activedate),
						htmlentities(@$row->keterangan),
						$action,
						$recorddataUserAccount /*proses tambahan hanya untuk pebandingan nama di data dengan investor*/
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
		$model = new SlotForm;
		if(isset($_POST['SlotForm'])){
			$model->attributes = $_POST['SlotForm'];
			if($model->validate()){
				if($model->save())
                {
                	$this->redirect(Yii::app()->createUrl('admin/slot'));
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
		$model = new SlotForm;
		if(isset($_POST['SlotForm'])){
		    $model->attributes = $_POST['SlotForm'];
		    if($model->validate()){
				if($model->save())
                {
                	$this->redirect(Yii::app()->createUrl('admin/slot'));
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
		$criteria->addSearchCondition('id_slot',$i,true,'=');
		$data = Slot::model()->find($criteria);

		if($data->delete()) {
			/*Jika ada Proses slot berikutnya*/
			$model = new Slot;
			$criteriaSlotSetelahnya = new CDbCriteria();
			$criteriaSlotSetelahnya->condition  = "userid=".$data->userid." AND id_slot > ".$_GET['i']."";
			$SlotAkhirSetelahnya = Slot::model()->findAll($criteriaSlotSetelahnya);
			if(!empty($SlotAkhirSetelahnya)){
				foreach ($SlotAkhirSetelahnya as $valSlotAkhirSetelahnya) {
					if(!empty($data->debit)){
						$update = $model->updateByPk($valSlotAkhirSetelahnya->id_slot,array(
							'slot_akhir' => $valSlotAkhirSetelahnya->slot_akhir - $data->debit
						));
					}
					if(!empty($data->kredit)){
						$update = $model->updateByPk($valSlotAkhirSetelahnya->id_slot,array(
							'slot_akhir' => $valSlotAkhirSetelahnya->slot_akhir + $data->kredit
						));
					}
				}
			}
			/*Jika ada Proses slot berikutnya*/	

           echo "YES";

        } else {
           echo "NO";
        }		
	}	
}