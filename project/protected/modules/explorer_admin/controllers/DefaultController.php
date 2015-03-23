<?php

class DefaultController extends Controller
{
	public $layout='/layouts/main';

	public function actionIndex()
	{
		$scriptsAdd = array(
            array(
                'type'=>'css',
                'file'=>'assets/admin/libs/jquery-notifyjs/styles/metro/notify-metro'
            ),
            array(
                'type'=>'js',
                'file'=>'assets/admin/libs/jquery-notifyjs/notify.min'
            ),
            array(
                'type'=>'js',
                'file'=>'assets/admin/libs/jquery-notifyjs/styles/metro/notify-metro'
            ),
            array(
                'type'=>'js',
                'file'=>'assets/admin/js/pages/notifications'
            )
        );
        $this->addScripts($scriptsAdd);
		$this->writeScripts();

		if (!Yii::app()->user->isGuest){
			$galleries = Galleries::model()->findAllByAttributes(array('status'=>1, 'save'=>1), array('order'=>'t.name ASC'));
			$currentGallery = Variables::model()->findByPk(1);
			$currentGallery = Galleries::model()->findByPk($currentGallery->value);

			$this->render('index', array(
				'galleries'=>$galleries,
				'currentGallery'=>$currentGallery
			));
		}
		else
			$this->redirect(array('login'));
	}

	public function actionLogin()
	{
		$this->layout = '/layouts/login';
		$model=new LoginForm();

		// if it is ajax validation request
		if(Yii::app()->getRequest()->getIsAjaxRequest()) {
			$model->attributes=$_POST['LoginForm'];
			$model->login();
			if (CActiveForm::validate($model)!="[]")
				echo CActiveForm::validate($model);
			else{
				echo "null";
			}
			Yii::app()->end();
		}
		else{
			if (Yii::app()->user->isGuest) {
				$this->render('login',array('model'=>$model));
			}
			else{
				if(Yii::app()->user->getState('_type') != 'admin'){
					Yii::app()->user->logout();
					$this->render('login',array('model'=>$model));
				}
				Yii::app()->user->setReturnUrl('index');
				$this->redirect(Yii::app()->user->returnUrl);
			}
		}
	}

	public function actionLogout(){
		Yii::app()->user->logout();
		$this->redirect(array('login'));
	}
}