<?php

/**
 * This is the model class for table "menuutama".
 *
 * The followings are the available columns in table 'menuutama':
 * @property integer $id
 * @property integer $sort
 * @property integer $parentid
 * @property string $title
 * @property string $link
 */
class Menuutama extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'menuutama';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sort, parentid, title, link', 'required'),
			array('sort, parentid', 'numerical', 'integerOnly'=>true),
			array('title, link', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, sort, parentid, title, link', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'childs' => array(self::HAS_MANY, 'Menuutama', 'parentid', 'order' => 'Sort ASC')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'sort' => 'Sort',
			'parentid' => 'Parentid',
			'title' => 'Title',
			'link' => 'Link',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('parentid',$this->parentid);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('link',$this->link,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Menuutama the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getListed() {
		$subitems = array();
		if($this->childs) {
			foreach($this->childs as $child) {
				$subitems[] = $child->getListed();
			}
		}
		$returnarray = array('label' => $this->title, 'url' => '#'.$this->id);
		if($subitems != array()) 
		    $returnarray = array_merge($returnarray, array('items' => $subitems));
		return $returnarray;
	}
}
