<?php

/**
 * This is the model class for table "appmenu".
 *
 * The followings are the available columns in table 'appmenu':
 * @property integer $MenuID
 * @property integer $Sort
 * @property integer $ParentID
 * @property string $Title
 * @property string $Link
 */
class Appmenu extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'appmenu';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Sort', 'required'),
			array('Sort, ParentID', 'numerical', 'integerOnly'=>true),
			array('Title, Link', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('MenuID, Sort, ParentID, Title, Link', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'MenuID' => 'Menu',
			'Sort' => 'Sort',
			'ParentID' => 'Parent',
			'Title' => 'Title',
			'Link' => 'Link',
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

		$criteria->compare('MenuID',$this->MenuID);
		$criteria->compare('Sort',$this->Sort);
		$criteria->compare('ParentID',$this->ParentID);
		$criteria->compare('Title',$this->Title,true);
		$criteria->compare('Link',$this->Link,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Appmenu the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
