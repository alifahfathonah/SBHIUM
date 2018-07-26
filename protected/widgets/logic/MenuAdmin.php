<?php
class MenuAdmin extends CWidget{
    public $data;
    public $datachild;
    public $widget;


    public function init(){
    $this->widget = __CLASS__;
    $criteria = new CDbCriteria;
    $criteria->addSearchCondition('ParentID','0',true,'=');
    $criteria->addNotInCondition('ParentID', array(140));
    $criteria->order = 'Sort ASC'; 
	$this->data = Appmenu::model()->findAll($criteria);

    }
    
    public function run(){
        $this->render('application.widgets.views.'.__CLASS__,array('data'=>$this->data));
    }
}
?>