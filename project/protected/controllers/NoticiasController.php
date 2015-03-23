<?php

class NoticiasController extends Controller
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
                'actions'=>array('index','view'),
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
        $id = explode('_', $id);
        $new = $this->loadModel($id[0]);
        $this->pageTitle='Explorer - '.$new->title;

        $this->render('view',array(
            'new'=>$new,
        ));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        MyMethods::setLanguage();
        $language = Yii::app()->request->cookies['language']->value;

        $page = Pages::model()->findByAttributes(array('language'=>$language, 'original'=>3));
        if($page == null)
            $page = Pages::model()->findByPk(3);
        $news = News::model()->findAllByAttributes(array('language'=>$language, 'status'=>1), array('order'=>'t.date DESC'));
        $this->pageTitle='Explorer - '.$page->title;
        $this->render('index',array(
            'news'=>$news,
            'language'=>$language,
            'page'=>$page
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return News the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=News::model()->findByAttributes(array('id_new'=>$id, 'status'=>1));
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param News $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='news-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}