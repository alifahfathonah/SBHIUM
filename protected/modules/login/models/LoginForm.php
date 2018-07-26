<?php 
class LoginForm extends CFormModel
{
	public $username;
	public $password;
	public $rememberMe;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password', 'required')
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe'=>'Remember me next time',
			'username'=>Yii::t('registration','username'),
			'password'=>Yii::t('registration','password')
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			if(!$this->_identity->authenticate())
				$this->addError('password','Incorrect username or password.');
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return string	ErrorMessage
	 */
	public function login()
	{
		$ws = new ws_datamaster();
		$auth = $ws->rdo6_1_1_LoginUser($this->username,$this->password);
		// Invalid username or password
		if($auth->UserID==""){
			return $auth->ErrorMessage;
		}else{
			Yii::app()->user->setState('UserID',$auth->UserID);
			Yii::app()->user->setState('UserSessionTokenID',$auth->UserSessionTokenID);
			Yii::app()->user->setState('UserName',$auth->UserName);
			Yii::app()->user->setState('FullName',$auth->FullName);
			Yii::app()->user->setState('UserNameTypeID',$auth->UserNameTypeID);
			Yii::app()->user->setState('LastActivity', time());
			
			//nasabah
			if($auth->UserNameTypeID=='1'){
				Yii::app()->request->redirect(Yii::app()->createUrl('/dashboard'));
			}else{	//Admin (non nasabah)
				Yii::app()->request->redirect(Yii::app()->createUrl('/maintenance/default'));
			}
		}
	}

	public function login_dev()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}

     
}
?>