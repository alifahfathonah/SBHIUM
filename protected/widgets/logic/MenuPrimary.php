<?php
class MenuPrimary extends CWidget{
    public $data;
    public $datachild;
    public $widget;


    public function init(){
    $this->widget = __CLASS__;
    $criteria = new CDbCriteria;
    $criteria->addSearchCondition('parentid','0',false,'AND');
    $criteria->order = 'Sort ASC';
    $this->data = Menuutama::model()->findAll($criteria);
    }
    
    public function run(){
        $this->render('application.widgets.views.'.__CLASS__,array('data'=>$this->data));
    }
}
?>