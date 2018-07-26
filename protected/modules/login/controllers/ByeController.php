<?php

class ByeController extends Controller
{	
	public function actionIndex(){
		Yii::app()->user->logout();
		Yii::app()->user->setState('userid',null);
		Yii::app()->user->setState('email',null);
		Yii::app()->user->setState('role',null);
        Yii::app()->user->setState('username',null);
        Yii::app()->user->setState('Fullname',null);
        Yii::app()->user->setState('Phone',null);
        Yii::app()->user->setState('City',null);
        Yii::app()->user->setState('slot',null);
        Yii::app()->user->setState('nama_bank',null);
        Yii::app()->user->setState('rek_bank',null);
		Yii::app()->request->redirect(Yii::app()->createUrl('/login/'));
	}
}