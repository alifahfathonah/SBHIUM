<?php
class LoginRBACForm extends CFormModel {
    public $username;
    public $password;
    private $identity;
    public $errorMessage;
    
    public function rules(){
        return array(
                // username and password are required
                array('username, password', 'required'),
                // password needs to be authenticated
                array('password', 'authenticate'),
        );
    }
    
    public function attributeLabels(){
        return array(
            'username'=>'Username',
            'password'=>'Password'
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
                    $this->_identity=new UserRBACIdentity($this->username,$this->password);
                    if(!$this->_identity->authenticate())
                            $this->addError('password','Incorrect username or password.');
            }
    }
    
    public function login(){
        if($this->identity==null){
            $this->identity = new UserRBACIdentity($this->username, $this->password);
            $this->identity->authenticate();
        }
        
        if($this->identity->errorCode===UserRBACIdentity::ERROR_NONE){
            Yii::app()->user->login($this->identity);
            return true;
        }else{
            $this->errorMessage = $this->identity->errorMessage;
            return false;
        }
    }
}

?>