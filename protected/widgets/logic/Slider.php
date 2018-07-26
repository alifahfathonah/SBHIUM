<?php
class Slider extends CWidget{
    public $data;
    public $widget;
    
    public function init(){
        $this->widget = __CLASS__;
    }
    
    public function run(){
        $this->render('application.widgets.views.'.__CLASS__);
    }
}
?>