<?php

class PagesController extends Controller
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
                    'delete_page',
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

        $pages = Pages::model()->findAllByAttributes(array('editable'=>1, 'original'=>null), array('condition'=>'t.status != 2', 'order'=>'t.title ASC'));

        $this->render('admin',array(
            'pages'=>$pages,
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

        $model=new Pages;
        $languages = Languages::model()->findAllByAttributes(array('status'=>1));
        $galleries = Galleries::model()->findAllByAttributes(array('status'=>1));

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Page']))
        {
            $original = null;
            $errors = false;
            for($i = 0; $i < count($languages); $i++) {
                if(isset($_POST['Page'][$i])){
                    $model=new Pages;

                    $model->attributes = $_POST['Page'][$i];
                    $model->navigation = MyMethods::normalizarUrl($model->title);
                    $model->original = $original;
                    $model->date = new CDbExpression('now()');
                    $model->clearErrors();
                    if($model->validate(null, false)){
                        if($model->save()){
                            if($i == 0){
                                $original = $model->id_page;
                                if(isset($_POST['Page']['gallery'])){
                                    $gallery = new PagesHasGalleries;
                                    $gallery->attributes = array(
                                                            'page'=>$model->id_page,
                                                            'gallery'=>$_POST['Page']['gallery'],);
                                    $gallery->save();
                                }
                            }
                            $current = Pages::model()->findByAttributes(array('navigation'=>$model->navigation), array('condition'=>'t.id_page != '.$model->id_page));
                            if($current != null){
                                $model->navigation = $model->id_page.'_'.$model->navigation;
                                $model->save();
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
            'languages'=>$languages,
            'galleries'=>$galleries
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
            'model'=>$this->loadModel($id),
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

        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if($model->editable == 1 && $model->original == null){
            $this->writeScripts();

            $languages = Languages::model()->findAllByAttributes(array('status'=>1));
            $galleries = Galleries::model()->findAllByAttributes(array('status'=>1));

            if(isset($_POST['Page']))
            {
                $original = null;
                $errors = false;
                for($i = 0; $i < count($languages); $i++) {
                    if($i != 0)
                        $model = Pages::model()->findByAttributes(array('original'=>$original, 'language'=>$_POST['Page'][$i]['language']));
                    if($model == null)
                        $model=new Pages;

                    $model->attributes = $_POST['Page'][$i];
                    if($model->isNewRecord){
                        $model->navigation = MyMethods::normalizarUrl($model->title);
                        $model->original = $original;
                        $model->date = new CDbExpression('now()');
                    }
                    $model->clearErrors();
                    if($model->validate(null, false)){
                        if($model->save()){
                            if($i == 0){
                                $original = $model->id_page;

                                if(isset($_POST['Page']['gallery'])){
                                    $currentGallery = PagesHasGalleries::model()->findAllByAttributes(array('page'=>$model->id_page));
                                    foreach ($currentGallery as $key => $gallery) {
                                        $gallery->delete();
                                    }

                                    $gallery = new PagesHasGalleries;
                                    $gallery->attributes = array(
                                                            'page'=>$model->id_page,
                                                            'gallery'=>$_POST['Page']['gallery'],);
                                    $gallery->save();
                                }
                            }
                        }
                        else
                            $errors = true;
                    }
                }
                if(!$errors)
                    $this->redirect(array('admin'));
            }

            $this->render('update',array(
                'model'=>$model,
                'languages'=>$languages,
                'galleries'=>$galleries
            ));
        }
        else
            throw new CHttpException(404,'The requested page does not exist.');
    }

    public function actionStatus($id){
        $page = $this->loadModel($id);

        if($page->editable == 1){
            if($page->status == 1)
                $page->status = 0;
            else if($page->status == 0)
                $page->status = 1;
            else
                throw new CHttpException(404,'The requested page does not exist.');

            $page->save();
            $this->redirect(array('admin'));
        }
        else
            throw new CHttpException(404,'The requested page does not exist.');
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete_page($id)
    {
        $page = $this->loadModel($id);

        if($page->editable == 1){
            $page->status = 2;
            if($page->save()){
                foreach ($page->pages as $key => $child) {
                    $child->status = 2;
                    $child->save();
                }
            }
        }

        $this->redirect(array('admin'));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Pages the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=Pages::model()->findByAttributes(array('id_page'=>$id), array('condition'=>'t.status != 2'));
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Pages $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='pages-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}