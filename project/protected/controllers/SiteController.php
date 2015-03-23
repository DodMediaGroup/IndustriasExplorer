<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		MyMethods::setLanguage();
		$language = Yii::app()->request->cookies['language']->value;
		$this->pageTitle='Explorer';

		$slide = Variables::model()->findByPk(1);
		$slide = Galleries::model()->findByPk($slide->value);

		$news = News::model()->findAllByAttributes(array('language'=>$language), array('limit'=>2, 'order'=>'t.id_new DESC'));

		$this->render('index', array(
			'slide'=>$slide,
			'news'=>$news
		));
	}

	public function actionContact(){
		if(Yii::app()->getRequest()->getIsAjaxRequest()){
			$result = array(
				'status'=>'success',
				'message'=>'Tu mensaje se envio con exito. Te responderemos en el menor tiempo posible. Gracias.'
			);

			$emailContent = '<strong>Hola</strong><br><br>'.
                '<p style="color:#444444;">Un mensaje a sido enviado desde el formulario de la web de Explrer.</p><br>'.
                '<p><strong>Nombre:</strong> '.((isset($_POST['name'])?$_POST['name']:'-----')).'</p>'.
                '<p><strong>Apellidos:</strong> '.((isset($_POST['last_name'])?$_POST['last_name']:'-----')).'</p>'.
                '<p><strong>Correo Electrónico:</strong> '.((isset($_POST['email'])?$_POST['email']:'-----')).'</p><br>'.
                '<p><strong>Asunto:</strong> '.((isset($_POST['subjet'])?$_POST['subjet']:'-----')).'</p>'.
                '<p><strong>Mensaje:</strong> '.((isset($_POST['message'])?$_POST['message']:'-----')).'</p><br>';

            @MyMethods::sentMail(((isset($_POST['subjet'])?$_POST['subjet']:'Mensaje enviado desde web de Explorer')), ((isset($_POST['email'])?$_POST['email']:'web@explorer.com')), Yii::app()->params['contactEmail'], $emailContent, array('fromName'=>'Industrias Explorer'));

			echo CJSON::encode($result);
		}
		else
			throw new CHttpException(404,'The requested page does not exist.');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$this->redirect(Yii::app()->homeUrl);
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}