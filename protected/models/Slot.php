<?php

/**
 * This is the model class for table "slot".
 *
 * The followings are the available columns in table 'slot':
 * @property integer $id_slot
 * @property integer $userid
 * @property string $input_date
 * @property string $active_date
 * @property string $keterangan
 * @property integer $debit
 * @property integer $kredit
 * @property integer $slot_akhir
 */
class Slot extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'slot';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userid, input_date, active_date', 'required'),
			array('userid, debit, kredit, slot_akhir', 'numerical', 'integerOnly'=>true),
			array('keterangan', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_slot, userid, input_date, active_date, keterangan, debit, kredit, slot_akhir', 'safe', 'on'=>'search'),
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
			'tUserAccount' => array(self::BELONGS_TO, 'UserAccount', 'userid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_slot' => 'Id Slot',
			'userid' => 'Userid',
			'input_date' => 'Input Date',
			'active_date' => 'Active Date',
			'keterangan' => 'Keterangan',
			'debit' => 'Debit',
			'kredit' => 'Kredit',
			'slot_akhir' => 'Slot Akhir',
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

		$criteria->compare('id_slot',$this->id_slot);
		$criteria->compare('userid',$this->userid);
		$criteria->compare('input_date',$this->input_date,true);
		$criteria->compare('active_date',$this->active_date,true);
		$criteria->compare('keterangan',$this->keterangan,true);
		$criteria->compare('debit',$this->debit);
		$criteria->compare('kredit',$this->kredit);
		$criteria->compare('slot_akhir',$this->slot_akhir);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Slot the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
