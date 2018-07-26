<?php 
class UsersForm extends CFormModel
{
	public $userid;
	public $username;
	public $email;
	public $Fullname;
	public $Password;
	public $Phone;
	public $City;
	public $nama_bank;
	public $rek_bank;
	// public $slot;
	public $IsActive;
	public $role;
	public $saveType;
	public $RetypePassword;
  	public $NewPassword;
	
	

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, email, Password, Fullname, Phone, City, nama_bank, rek_bank, IsActive, role, saveType', 'required', 'on' => array('add', 'edit')),
			array('NewPassword','length','min'=>1),
            array('RetypePassword','compare','compareAttribute'=>'NewPassword','operator'=>'==','message'=>'Passsword Baru tidak cocok dengan {attribute}.'),
            array('NewPassword, RetypePassword','required','on'=>'changePassword')
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			
			'username'=>'Username',
			'email'=>'Email',
			'Fullname'=>'Nama Lengkap',
			'Phone'=>'No. Handphone',
			'City'=>'Alamat',
			'IsActive'=>'Is Active',
			'nama_bank'=>'Nama Bank',
			'rek_bank'=>'No Rekening',
			// 'slot'=>'Slot',
			'role'=>'Role',
			'NewPassword'=>'Password Baru',
			'RetypePassword'=>'Ulangi Password',

		);
	}

	public function dataSource($object){
        switch($object){
			case 'role' :
				$return = CHtml::listData(Role::model()->findAll(),'id_role','nama');
				break;
		}
        return $return;
    }

	public function editcontent($i){
		$criteria = new CDbCriteria;
		$criteria->addSearchCondition('userid',$i,true,'=');
		$data = UserAccount::model()->find($criteria);
		$this->userid = $data->userid;
		$this->username = $data->username;
		$this->email = $data->email;
		$this->Password = $data->Password;
		$this->Fullname = $data->Fullname;
		$this->Phone = $data->Phone;
		$this->City = $data->City;
		$this->nama_bank = $data->nama_bank;
		$this->rek_bank = $data->rek_bank;
		// $this->slot = $data->slot;
		$this->IsActive = $data->IsActive;
		$this->role = $data->role;
		$this->saveType = 'edit';
	}

	public function changePassword($i){
        $this->userid = $i;
	}

	public function saveChangePassword(){
		$model = new UserAccount;
		$criteria = new CDbCriteria;
		$criteria->addSearchCondition('userid',$_GET['i'],true,'=');
		$data = UserAccount::model()->find($criteria);
		$update = $model->updateByPk($_GET['i'],array(
					'Password' => md5($this->NewPassword)));
		if($update){
		   return true;
		}else{
			return false;
		}
	}

	public function save(){

		$post = new UserAccount;
		if ($this->saveType=='edit'){
			$criteria = new CDbCriteria;
			$criteria->addSearchCondition('userid',$_GET['i'],true,'=');
			$data = UserAccount::model()->find($criteria);
			$update = $post->updateByPk($_GET['i'],array(
					'username' =>  $this->username,
					'email' =>  $this->email,
					'Password' => $data->Password,
					// 'Password' => md5($this->Password),
					'Fullname' => $this->Fullname,
					'Phone' => $this->Phone,
					'City' => $this->City, 
					'nama_bank' => $this->nama_bank, 
					'rek_bank' => $this->rek_bank, 
					// 'slot' => $this->slot, 
					'IsActive' => $this->IsActive,
					'role' => $this->role,
					'sysCreatedBy' => Yii::app()->user->getState('username'),
					'sysCreatedDate' => date('Y-m-d h:i:s')

				));
			if($update){
			   return true;
			}else{
				return false;
			}
		}elseif ($this->saveType=='add'){

			$post->username =  $this->username;
			$post->email =  $this->email;
			$post->Password = md5($this->Password);
			$post->Fullname = $this->Fullname;
			$post->Phone = $this->Phone;
			$post->City = $this->City; 
			$post->nama_bank = $this->nama_bank; 
			$post->rek_bank = $this->rek_bank; 
			// $post->slot = $this->slot; 
			$post->IsActive = $this->IsActive;  
			$post->role = $this->role;  
			$post->sysCreatedBy = Yii::app()->user->getState('username');
			$post->sysCreatedDate = date('Y-m-d h:i:s');
			$post->save();

			if ($post->validate()){
				$post->save();
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
}
?>