<?php

class UserRBACIdentity extends CUserIdentity{

    public function authenticate(){

        $record = UserAccount::model()->findByAttributes(array('username'=>$this->username));

        

        if(is_null($record)){

            $this->errorCode=self::ERROR_USERNAME_INVALID;

            $this->errorMessage='Invalid Username';

        }else if($record->Password!=md5($this->password)){

            $this->errorCode=self::ERROR_PASSWORD_INVALID;

            $this->errorMessage='Invalid Password';

        }else{

            $this->errorCode = self::ERROR_NONE;

            Yii::app()->user->setState('userid',$record->userid);

            Yii::app()->user->setState('role',$record->role);

            Yii::app()->user->setState('username',$record->username);

            Yii::app()->user->setState('email',$record->email);

            Yii::app()->user->setState('Fullname',$record->Fullname);

            Yii::app()->user->setState('Phone',$record->Phone);

            Yii::app()->user->setState('City',$record->City);

            Yii::app()->user->setState('nama_bank',$record->nama_bank);

            Yii::app()->user->setState('rek_bank',$record->rek_bank);

        }

    }

}



?>