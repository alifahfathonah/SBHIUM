<?php

class DefaultController extends Controller
{	
	public function actionIndex(){
		$this->layout = "login";
		$this->pageTitle = Yii::app()->name.' :: '.'Login';
		$model = new LoginRBACForm;
		if(isset($_POST['LoginRBACForm'])){
			$model->attributes = $_POST['LoginRBACForm'];
			$login = $model->login();
			if($login){
				$this->redirect($this->createUrl('/admin/dashboard'));
			}
		}
		$this->render('index',array('model'=>$model));
	}
}