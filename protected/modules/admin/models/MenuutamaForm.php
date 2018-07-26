<?php 
class MenuutamaForm extends CFormModel
{
	public $id;
 	public $sort;
	public $parentid;
	public $parentname;
	public $title;
	public $link;
	public $redirectTo;
	public $saveType;
	
	

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('sort, parentid, title, link, saveType', 'required'),
			array('sort, parentid', 'numerical', 'integerOnly'=>true),
			array('title, link, redirectTo', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, sort, parentid, title, link', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			
			'id' => 'ID',
			'sort' => 'Sort',
			'parentid' => 'Parentid',
			'parentname' => 'Parent Menu',
			'title' => 'Title',
			'link' => 'Link',

		);
	}

	public function add(){
        $this->saveType = 'add';
        $parent = Menuutama::model()->findByAttributes(array('id'=>@$_GET['p']));
        $this->parentid = @$parent->id;
        $this->parentname = @$parent->title;
    }

	public function edit(){
        $data = Menuutama::model()->findByPk($_GET['i']);
        $this->sort = $data->sort;
        $this->parentid = $data->parentid;
        $this->title = $data->title;
        $this->link = $data->link;
        $this->saveType = 'edit';        
    }

    public function dataSource($object){
        $return = array();
        switch($object){
            case 'parentmenu':
                $return = CHtml::listData(Menuutama::model()->findAll(),'id','title');
                break;
        }
        
        return $return;
    }

	public function save(){
        $model = new Menuutama();
        if($this->saveType=='add_main'){
            $model->sort = $this->sort;
            $model->parentid = $this->parentid;
            $model->title = $this->title;
            $model->link = $this->link;
            $model->save();
            
            if($this->redirectTo!=''){
                Yii::app()->request->redirect(Yii::app()->createUrl($this->redirectTo));
            }else{
                $this->title = $this->sort = null;/*biar balik ke add lagi*/
            }            
        }elseif($this->saveType=='add'){
        	$model->sort = $this->sort;
            $model->parentid = $this->parentid;
            $model->title = $this->title;
            $model->link = $this->link;
            $model->save();
            
            if($this->redirectTo!=''){
                Yii::app()->request->redirect(Yii::app()->createUrl($this->redirectTo));
            }else{
                $this->title = $this->sort = null;/*biar balik ke add lagi*/
            }
        }else{
            $model->updateByPk($_GET['i'],array('sort'=>$this->sort,
            										   'parentid'=>$this->parentid,
                                                       'title'=>$this->title,
                                                       'link'=>$this->link));
            
            Yii::app()->request->redirect(Yii::app()->createUrl('admin/menu'));
        }
    }
}
?>