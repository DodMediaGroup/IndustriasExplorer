<?php

class ClientsController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='/layouts/main';

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
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array(
                    'admin',
                    'create',
                    'update',
                    'status',
                    'delete_client',

                    'orders',
                    'orders_add',
                    'orders_update',
                    'order_status',
                    'delete_order',

                    'reports',
                    'report_add',
                    'reports_update',
                    'report_status',
                    'delete_report'
                ),
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $scriptsAdd = array(
            array(
                'type'=>'css',
                'file'=>'assets/admin/libs/jquery-datatables/css/dataTables.bootstrap'
            ),
            array(
                'type'=>'css',
                'file'=>'assets/admin/libs/jquery-datatables/extensions/TableTools/css/dataTables.tableTools'
            ),
            array(
                'type'=>'js',
                'file'=>'assets/admin/libs/jquery-datatables/js/jquery.dataTables.min'
            ),
            array(
                'type'=>'js',
                'file'=>'assets/admin/libs/jquery-datatables/js/dataTables.bootstrap'
            ),
            array(
                'type'=>'js',
                'file'=>'assets/admin/libs/jquery-datatables/extensions/TableTools/js/dataTables.tableTools.min'
            )
        );
        $this->addScripts($scriptsAdd);
        $this->writeScripts();

        $clients = Clients::model()->findAll(array('condition'=>'t.status != 2', 'order'=>'t.name DESC'));

        $this->render('admin',array(
            'clients'=>$clients,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $this->writeScripts();

        $model=new Clients;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Clients']))
        {
            $error = false;
            $model->attributes = $_POST['Clients'];

            $users = Clients::model()->findAllByAttributes(array('user'=>$model->user), array('condition'=>'t.status != 2'));
            if($users != null){
                $model->addError('user', 'Ya se encuentra un cliente registrado con ese usuario!!!');
                $error = true;
            }

            if(trim($_POST['Clients']['password']) == ''){
                $model->addError('password', 'Debe agregar un password para el usuario!!!');
                $error = true;
            }
            else
                $model->password = MyMethods::crypt_blowfish($_POST['Clients']['password']);

            if(!$error && $model->save()){
                if(($_FILES['image']['size'] > 0)){
                    $server = $_SERVER['DOCUMENT_ROOT'].Yii::app()->request->baseUrl.'/images/';
                    
                    $uploadLogo = MyMethods::uploadImage($_FILES['image'], 512, 'clients/');

                    if(!$uploadLogo['status']){
                        $model->addError('image', $uploadLogo['message']);
                    }
                    else{
                        $model->image = $uploadLogo['imageName'];
                        $model->save();
                    }
                }
                $this->redirect(array('admin'));
            }
        }

        $this->render('create',array(
            'model'=>$model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $this->writeScripts();

        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Clients']))
        {
            $error = false;

            $model->name = $_POST['Clients']['name'];
            $model->user = $_POST['Clients']['user'];

            $users = Clients::model()->findAllByAttributes(array('user'=>$model->user), array('condition'=>'t.status != 2 and t.id_client != '.$model->id_client));
            if($users != null){
                $model->addError('user', 'Ya se encuentra un cliente registrado con ese usuario!!!');
                $error = true;
            }

            if(trim($_POST['Clients']['password']) != '')
                $model->password = MyMethods::crypt_blowfish($_POST['Clients']['password']);

            if(!$error && $model->save()){
                if(($_FILES['image']['size'] > 0)){
                    $server = $_SERVER['DOCUMENT_ROOT'].Yii::app()->request->baseUrl.'/images/';
                    
                    $uploadLogo = MyMethods::uploadImage($_FILES['image'], 512, 'clients/');

                    if(!$uploadLogo['status']){
                        $model->addError('image', $uploadLogo['message']);
                    }
                    else{
                        $model->image = $uploadLogo['imageName'];
                        $model->save();
                    }
                }
                $this->redirect(array('admin'));
            }
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionStatus($id)
    {
        $client = $this->loadModel($id);
        if($client->status == 1)
            $client->status = 0;
        else if($client->status == 0)
            $client->status = 1;
        else
            throw new CHttpException(404,'The requested page does not exist.');

        $client->save();

        $this->redirect(array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionDelete_client($id)
    {
        $client = $this->loadModel($id);
        
        $client->status = 2;
        $client->save();

        $this->redirect(array('admin'));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Clients the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=Clients::model()->findByAttributes(array('id_client'=>$id), array('condition'=>'t.status != 2'));
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Manages all models.
     */
    public function actionOrders($id)
    {
        $scriptsAdd = array(
            array(
                'type'=>'css',
                'file'=>'assets/admin/libs/jquery-datatables/css/dataTables.bootstrap'
            ),
            array(
                'type'=>'css',
                'file'=>'assets/admin/libs/jquery-datatables/extensions/TableTools/css/dataTables.tableTools'
            ),
            array(
                'type'=>'js',
                'file'=>'assets/admin/libs/jquery-datatables/js/jquery.dataTables.min'
            ),
            array(
                'type'=>'js',
                'file'=>'assets/admin/libs/jquery-datatables/js/dataTables.bootstrap'
            ),
            array(
                'type'=>'js',
                'file'=>'assets/admin/libs/jquery-datatables/extensions/TableTools/js/dataTables.tableTools.min'
            )
        );
        $this->addScripts($scriptsAdd);
        $this->writeScripts();

        $client = $this->loadModel($id);
        $orders = WorkOrders::model()->findAllByAttributes(array('client'=>$id),array('condition'=>'t.status != 2', 'order'=>'t.id_order DESC'));

        $this->render('orders',array(
            'client'=>$client,
            'orders'=>$orders,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionOrders_add($id)
    {
        $this->writeScripts();

        $model=new WorkOrders;
        $client = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['WorkOrders']))
        {
            $model->attributes = $_POST['WorkOrders'];
            $model->client = $client->id_client;

            if($model->save()){
                $this->redirect(array('clients/orders/'.$client->id_client));
            }
        }

        $this->render('order_add',array(
            'model'=>$model,
            'client'=>$client,
        ));
    }

    public function actionOrders_update($id)
    {
        $this->writeScripts();

        $model = $this->loadOrder($id);
        $client = $this->loadModel($model->client);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['WorkOrders']))
        {
            $model->attributes = $_POST['WorkOrders'];

            if($model->save()){
                $this->redirect(array('clients/orders/'.$client->id_client));
            }
        }

        $this->render('order_add',array(
            'model'=>$model,
            'client'=>$client,
        ));
    }

    public function actionOrder_status($id){
        $order = $this->loadOrder($id);
        if($order->status == 1)
            $order->status = 0;
        else if($order->status == 0)
            $order->status = 1;
        else
            throw new CHttpException(404,'The requested page does not exist.');

        $order->save();

        $this->redirect(array('clients/orders/'.$order->client));
    }

    public function actionDelete_order($id)
    {
        $order = $this->loadOrder($id);
        
        $order->status = 2;
        $order->save();

        $this->redirect(array('clients/orders/'.$order->client));
    }

    public function loadOrder($id)
    {
        $model=WorkOrders::model()->findByAttributes(array('id_order'=>$id), array('condition'=>'t.status != 2'));
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Manages all models.
     */
    public function actionReports($id)
    {
        $scriptsAdd = array(
            array(
                'type'=>'css',
                'file'=>'assets/admin/libs/jquery-datatables/css/dataTables.bootstrap'
            ),
            array(
                'type'=>'css',
                'file'=>'assets/admin/libs/jquery-datatables/extensions/TableTools/css/dataTables.tableTools'
            ),
            array(
                'type'=>'js',
                'file'=>'assets/admin/libs/jquery-datatables/js/jquery.dataTables.min'
            ),
            array(
                'type'=>'js',
                'file'=>'assets/admin/libs/jquery-datatables/js/dataTables.bootstrap'
            ),
            array(
                'type'=>'js',
                'file'=>'assets/admin/libs/jquery-datatables/extensions/TableTools/js/dataTables.tableTools.min'
            )
        );
        $this->addScripts($scriptsAdd);
        $this->writeScripts();

        $order = $this->loadOrder($id);
        $reports = Reports::model()->findAllByAttributes(array('work_order'=>$id),array('condition'=>'t.status != 2', 'order'=>'t.id_report DESC'));

        $this->render('reports',array(
            'order'=>$order,
            'reports'=>$reports,
        ));
    }

    public function actionReport_add($id){
        $this->writeScripts();

        $model=new Reports;
        $order = $this->loadOrder($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Reports']))
        {
            $model->attributes = $_POST['Reports'];
            $model->work_order = $order->id_order;
            if($_FILES['file']['size'] > 0){
                if($_FILES['file']['size'] > (2048*1024))
                    $model->addError('file', 'El archivo es demasiado pesado!!!');
                else{
                    if((MyMethods::isValidDate($_POST['Reports']['date'], 'd/m/Y'))){
                        $date = @date_create(str_replace("/","-",trim($_POST['Reports']['date'])), new DateTimeZone('Europe/London'));
                        $model->date = date_format($date, 'Y/m/d');
                    }
                    $model->file = "Error en carga";
                    if($model->save()){
                        $nameImage = $model->id_report."_".$_FILES['file']['name'];
                        $tempFile = $_FILES['file']['tmp_name'];
                        $targetPath = $_SERVER['DOCUMENT_ROOT'].Yii::app()->request->baseUrl."/files/";
                        $targetFile =  $targetPath.$nameImage;
                        if(move_uploaded_file($tempFile, $targetFile)){
                            $model->file = $nameImage;
                            $model->save();
                        }

                        $this->redirect(array('clients/reports/'.$order->id_order));
                    }
                }
            }
            else
                $model->addError('file', 'Debe cargar un archivo para el informe!!!');
        }

        $this->render('report_add',array(
            'model'=>$model,
            'order'=>$order,
        ));
    }

    public function actionReports_update($id)
    {
        $this->writeScripts();

        $model = $this->loadReports($id);
        $order = $this->loadOrder($model->work_order);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Reports']))
        {
            $model->attributes = $_POST['Reports'];
            if($_FILES['file']['size'] > 0){
                if($_FILES['file']['size'] > (2048*1024))
                    $model->addError('file', 'El archivo es demasiado pesado!!!');
                else{
                    $nameImage = $model->id_report."_".$_FILES['file']['name'];
                    $tempFile = $_FILES['file']['tmp_name'];
                    $targetPath = $_SERVER['DOCUMENT_ROOT'].Yii::app()->request->baseUrl."/files/";
                    $targetFile =  $targetPath.$nameImage;
                    if(move_uploaded_file($tempFile, $targetFile)){
                        $model->file = $nameImage;
                        $model->save();
                    }
                }
            }
            if((MyMethods::isValidDate($_POST['Reports']['date'], 'd/m/Y'))){
                $date = @date_create(str_replace("/","-",trim($_POST['Reports']['date'])), new DateTimeZone('Europe/London'));
                $model->date = date_format($date, 'Y/m/d');
            }
            if($model->save()){
                $this->redirect(array('clients/reports/'.$order->id_order));
            }
        }

        $this->render('report_update',array(
            'model'=>$model,
            'order'=>$order,
        ));
    }

    public function actionReport_status($id){
        $report = $this->loadReports($id);
        if($report->status == 1)
            $report->status = 0;
        else if($report->status == 0)
            $report->status = 1;
        else
            throw new CHttpException(404,'The requested page does not exist.');

        $report->save();

        $this->redirect(array('clients/reports/'.$report->work_order));
    }

    public function actionDelete_report($id){
        $report = $this->loadReports($id);
        
        $report->status = 2;
        if($report->save()){
            @unlink($_SERVER['DOCUMENT_ROOT'].Yii::app()->request->baseUrl."/files/".$report->file);
        }

        $this->redirect(array('clients/reports/'.$report->work_order));
    }

    public function loadReports($id)
    {
        $model=Reports::model()->findByAttributes(array('id_report'=>$id), array('condition'=>'t.status != 2'));
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Clients $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='clients-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}