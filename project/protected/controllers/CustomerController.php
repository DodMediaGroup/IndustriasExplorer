<?php

class CustomerController extends Controller
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
                'actions'=>array(
                    'login',
                    'logout'
                ),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array(
                    'orders',
                    'order'
                ),
                'users'=>array('@'),
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
    public function actionLogin()
    {
        if(Yii::app()->request->isAjaxRequest){
            $values = array(
                'status'=>false,
                'message'=>'El usuario o contraseña son incorrectos.'
            );
            $login = false;

            if(Yii::app()->user->isGuest)
                $login = true;
            else if(Yii::app()->user->getState('_type') != 'client'){
                Yii::app()->user->logout();
                $login = true;
            }
            else{
                $login = false;
                $values['status'] = true;
            }

            if($login){
                $model=new LoginForm();
                $model->username=$_POST['username'];
                $model->password=$_POST['password'];
                if($model->loginClient())
                    $values['status'] = true;
            }

            echo CJSON::encode($values);

            Yii::app()->end();
        }
        else
            throw new CHttpException(404,'The requested page does not exist.');
    }

    public function actionLogout(){
        Yii::app()->user->logout();
        $this->redirect(array('/'));
    }

    public function actionOrders(){
        $orders = WorkOrders::model()->findAllByAttributes(array('client'=>Yii::app()->user->getState('_client'), 'status'=>1), array('order'=>'t.id_order DESC'));

        $this->pageTitle=Yii::app()->user->getState('_name').' - Ordenes de Trabajo';

        $this->render('orders',array(
            'orders'=>$orders
        ));
    }

    public function actionOrder($id){
        $id = explode('_', $id);
        $id = $id[0];

        $order = WorkOrders::model()->findByAttributes(array('id_order'=>$id, 'status'=>1));
        if($order != null){
            $reports = Reports::model()->findAllByAttributes(array('work_order'=>$id, 'status'=>1));
            $this->pageTitle=Yii::app()->user->getState('_name').' - Informes';
            $this->render('reports',array(
                'order'=>$order,
                'reports'=>$reports
            ));
        }
        else
            throw new CHttpException(404,'The requested page does not exist.');
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