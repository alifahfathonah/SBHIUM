<?php

/**
 * This is the model class for table "useraccount".
 *
 * The followings are the available columns in table 'useraccount':
 * @property string $userid
 * @property string $username
 * @property string $Password
 * @property string $Fullname
 * @property string $Phone
 * @property string $City
 * @property integer $IsActive
 * @property string $sysCreatedBy
 * @property string $sysCreatedDate
 * @property string $sysModifiedBy
 * @property string $sysModifiedDate
 */
class Useraccount extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'useraccount';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Password, Fullname, nama_bank, rek_bank, slot, IsActive, role, email', 'required'),
			array('IsActive', 'numerical', 'integerOnly'=>true),
			array('username, Password, Phone, sysCreatedBy, sysModifiedBy', 'length', 'max'=>50),
			array('Fullname', 'length', 'max'=>100),
			array('sysCreatedDate, City, sysModifiedDate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('userid, username, Password, Fullname, Phone, City, IsActive, sysCreatedBy, sysCreatedDate, sysModifiedBy, sysModifiedDate', 'safe', 'on'=>'search'),
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
			'tRole' => array(self::BELONGS_TO, 'Role', 'role'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'userid' => 'Userid',
			'username' => 'Username',
			'email' => 'email',
			'Password' => 'Password',
			'Fullname' => 'Fullname',
			'Phone' => 'Phone',
			'City' => 'City',
			'nama_bank' => 'Nama Bank',
			'rek_bank' => 'Nomor Rekening',
			'slot' => 'Slot',
			'IsActive' => 'Is Active',
			'role' => 'Role',
			'sysCreatedBy' => 'Sys Created By',
			'sysCreatedDate' => 'Sys Created Date',
			'sysModifiedBy' => 'Sys Modified By',
			'sysModifiedDate' => 'Sys Modified Date',
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

		$criteria->compare('userid',$this->userid,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('Password',$this->Password,true);
		$criteria->compare('Fullname',$this->Fullname,true);
		$criteria->compare('Phone',$this->Phone,true);
		$criteria->compare('City',$this->City,true);
		$criteria->compare('nama_bank',$this->nama_bank,true);
		$criteria->compare('rek_bank',$this->rek_bank,true);
		$criteria->compare('slot',$this->slot,true);
		$criteria->compare('IsActive',$this->IsActive);
		$criteria->compare('role',$this->role);
		$criteria->compare('sysCreatedBy',$this->sysCreatedBy,true);
		$criteria->compare('sysCreatedDate',$this->sysCreatedDate,true);
		$criteria->compare('sysModifiedBy',$this->sysModifiedBy,true);
		$criteria->compare('sysModifiedDate',$this->sysModifiedDate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Useraccount the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
