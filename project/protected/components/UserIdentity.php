<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate($type=null)
	{
		if($type == 'client'){
			$client = Clients::model()->findByAttributes(array('user'=>$this->username, 'status'=>1));
            if(!is_object($client))
                $this->errorCode=self::ERROR_USERNAME_INVALID;
            else if($client->user != $this->username)
            	$this->errorCode=self::ERROR_USERNAME_INVALID;
            else if(crypt($this->password, $client->password) != $client->password)
                $this->errorCode=self::ERROR_PASSWORD_INVALID;
            else{
            	$this->errorCode=self::ERROR_NONE;

                Yii::app()->user->setState('_client',$client->id_client);
                Yii::app()->user->setState('_name',$client->name);
                Yii::app()->user->setState('_type','client');
            }
		}
		else{
			$user = Users::model()->findByAttributes(array('email'=>$this->username,'status'=>1));

			if(!is_object($user))
				$this->errorCode=self::ERROR_USERNAME_INVALID;
			//else if($user->password!==$this->password)
			else if(crypt($this->password, $user->password) != $user->password)
				$this->errorCode=self::ERROR_PASSWORD_INVALID;
			else{
				$this->errorCode=self::ERROR_NONE;
				
				//Cargamos datos para aplicación
				$this->setState('_user',$user->id_user);
				$this->setState('_name',$user->name);
				$this->setState('_email',$user->email);
				$this->setState('_image',$user->image);

				$this->setState('_type','admin');
			}
			return !$this->errorCode;
		}
	}
}