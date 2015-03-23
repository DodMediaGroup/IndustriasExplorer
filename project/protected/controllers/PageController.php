<?php

class PageController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/main';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('view'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$page = $this->loadModel($id);
		Yii::app()->request->cookies['language'] = new CHttpCookie('language', $page->language);
		$this->pageTitle='Explorer - '.$page->title;

		if($id == 'contacto' || $id == 'contact'){
			$this->render('contact',array(
				'page'=>$page,
			));
		}
		else{
			$this->render('view',array(
				'page'=>$page,
			));
		}
	}

	/**
	 * Retorna eventos mediante ajax
	 */
	public function actionLoadAjax(){
		if(Yii::app()->getRequest()->getIsAjaxRequest()){
			$page = (isset($_GET['page']))?$_GET['page']:1;
			$items = (isset($_GET['items']))?$_GET['items']:3;;

			$criteria = new CDbCriteria;
			$criteria->condition = "t.status = :status ";
        	$criteria->params = array(":status"=>1);
			$criteria->order = 't.date_from ASC';
			$criteria->limit = $items;
    		$criteria->offset = ($items * $page) - $items;
			$events = Events::model()->findAll($criteria);

			$html = $this->renderPartial('_loadAjax', array('events'=>$events), true);

			echo CJSON::encode(array(
				'html'=>$html,
				'page'=>$page+1
			));
		}
		else
			throw new CHttpException(404,'The requested page does not exist.');
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Stores the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Pages::model()->findByAttributes(array('navigation'=>$id, 'status'=>1));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Stores $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='stores-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
