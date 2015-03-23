<?php

class PublicationsController extends Controller
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
                    'view',
                    'update',
                    'status',
                    'delete_publication'
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

        $publications = Publications::model()->findAllByAttributes(array('original'=>null),array('condition'=>'t.status != 2', 'order'=>'t.id_publication DESC'));

        $this->render('admin',array(
            'publications'=>$publications,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $scriptsAdd = array(
            array(
                'type'=>'js',
                'file'=>'assets/admin/libs/ckeditor/ckeditor'
            ),
            array(
                'type'=>'js',
                'file'=>'assets/admin/libs/ckeditor/adapters/jquery'
            ),
            array(
                'type'=>'js',
                'file'=>'assets/admin/libs/jquery-wizard/jquery.easyWizard'
            )
        );
        $this->addScripts($scriptsAdd, 'admin');
        $this->writeScripts();

        $model=new Publications;
        $languages = Languages::model()->findAllByAttributes(array('status'=>1));

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Publications']))
        {
            $original = null;
            $errors = false;
            for($i = 0; $i < count($languages); $i++) {
                if(isset($_POST['Publications'][$i])){
                    $model=new Publications;

                    $model->attributes = $_POST['Publications'][$i];
                    $model->original = $original;
                    $model->date = $_POST['Publications']['date'];
                    $model->clearErrors();
                    if($model->validate(null, false)){
                        if(!(MyMethods::isValidDate($_POST['Publications']['date'], 'd/m/Y'))){
                            date_default_timezone_set('America/Bogota');
                            $model->date = "";
                            $model->addError('date', 'El campo fecha no es una fecha valida!!!');
                            $errors = true;
                        }
                        else{
                            $date = @date_create(str_replace("/","-",trim($_POST['Publications']['date'])), new DateTimeZone('Europe/London'));
                            $model->date = date_format($date, 'Y/m/d');
                        }
                        if($_FILES['file']['size'] <= 0){
                            $model->addError('file', 'Debe cargar un archivo para la publicación!!!');
                            $errors = true;
                        }
                        else if($_FILES['file']['size'] > (2048*1024)){
                            $model->addError('file', 'El archivo es demasiado pesado!!!');
                            $errors = true;
                        }
                        if(!$errors && $model->save()){
                            if($i == 0){
                                $original = $model->id_publication;
                                
                                $nameImage = $model->id_publication."_".$_FILES['file']['name'];
                                $tempFile = $_FILES['file']['tmp_name'];
                                $targetPath = $_SERVER['DOCUMENT_ROOT'].Yii::app()->request->baseUrl."/files/publications/";
                                $targetFile =  $targetPath.$nameImage;
                                if(move_uploaded_file($tempFile, $targetFile)){
                                    $model->file = $nameImage;
                                    $model->save();
                                }
                            }
                        }
                        else
                            $errors = true;
                    }
                }
            }
            if(!$errors)
                $this->redirect(array('admin'));
        }

        $this->render('create',array(
            'model'=>$model,
            'languages'=>$languages
        ));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->writeScripts();

        $this->render('view',array(
            'publication'=>$this->loadModel($id),
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $scriptsAdd = array(
            array(
                'type'=>'js',
                'file'=>'assets/admin/libs/ckeditor/ckeditor'
            ),
            array(
                'type'=>'js',
                'file'=>'assets/admin/libs/ckeditor/adapters/jquery'
            ),
            array(
                'type'=>'js',
                'file'=>'assets/admin/libs/jquery-wizard/jquery.easyWizard'
            )
        );
        $this->addScripts($scriptsAdd, 'admin');
        $this->writeScripts();

        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if($model->original == null){
            $languages = Languages::model()->findAllByAttributes(array('status'=>1));

            if(isset($_POST['Publications']))
            {
                $original = null;
                $errors = false;
                for($i = 0; $i < count($languages); $i++) {
                    if($i != 0)
                        $model = Publications::model()->findByAttributes(array('original'=>$original, 'language'=>$_POST['Publications'][$i]['language']));
                    if($model == null)
                        $model=new Publications;

                    $model->attributes = $_POST['Publications'][$i];
                    if($model->isNewRecord){
                        $model->original = $original;
                        $model->date = $_POST['Publications']['date'];
                    }
                    $model->clearErrors();
                    if($model->validate(null, false)){
                        if(!(MyMethods::isValidDate($_POST['Publications']['date'], 'd/m/Y'))){
                            date_default_timezone_set('America/Bogota');
                            $model->date = "";
                            $model->addError('date', 'El campo fecha no es una fecha valida!!!');
                            $errors = true;
                        }
                        else{
                            $date = @date_create(str_replace("/","-",trim($_POST['Publications']['date'])), new DateTimeZone('Europe/London'));
                            $model->date = date_format($date, 'Y/m/d');
                        }
                        if(!$errors && $model->save()){
                            if($i == 0){
                                $original = $model->id_publication;

                                if(($_FILES['file']['size'] > 0)){
                                    $current = $model->file;
                                    $nameImage = $model->id_publication."_".$_FILES['file']['name'];
                                    $tempFile = $_FILES['file']['tmp_name'];
                                    $targetPath = $_SERVER['DOCUMENT_ROOT'].Yii::app()->request->baseUrl."/files/publications/";
                                    $targetFile =  $targetPath.$nameImage;
                                    if(move_uploaded_file($tempFile, $targetFile)){
                                        $model->file = $nameImage;
                                        $model->save();
                                        @unlink($_SERVER['DOCUMENT_ROOT'].Yii::app()->request->baseUrl."/files/publications/".$current);
                                    }
                                }
                            }
                        }
                        else
                            $errors = true;
                    }
                }
                if(!$errors)
                    $this->redirect(array('view', "id"=>$original));
            }

            $this->render('update',array(
                'model'=>$model,
                'languages'=>$languages
            ));    
        }
        else
            throw new CHttpException(404,'The requested page does not exist.');
    }

    public function actionStatus($id){
        $publication = $this->loadModel($id);
        if($publication->status == 1)
            $publication->status = 0;
        else if($publication->status == 0)
            $publication->status = 1;
        else
            throw new CHttpException(404,'The requested page does not exist.');

        if($publication->save()){
            foreach ($publication->publications as $key => $child) {
                $child->status = $child->original0->status;
                $child->save();
            }
        }
        $this->redirect(array('admin'));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete_publication($id)
    {
        $publication = $this->loadModel($id);

        $publication->status = 2;
        if($publication->save()){
            @unlink($_SERVER['DOCUMENT_ROOT'].Yii::app()->request->baseUrl."/files/publications/".$publication->file);

            foreach ($publication->publications as $key => $child) {
                $child->status = $child->original0->status;
                $child->save();
            }
        }

        $this->redirect(array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('News');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
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
        $model=Publications::model()->findByAttributes(array('id_publication'=>$id), array('condition'=>'t.status != 2'));
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Publications $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='publications-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}