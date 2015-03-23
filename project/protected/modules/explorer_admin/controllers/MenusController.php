<?php

class MenusController extends Controller
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
                    'delete_menu',
                    'update'
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

        $languages = Languages::model()->findAllByAttributes(array('status'=>1));

        $this->render('admin',array(
            'languages'=>$languages,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($id)
    {
        $scriptsAdd = array(
            array(
                'type'=>'css',
                'file'=>'assets/admin/libs/jquery-nestable/jquery.nestable'
            ),
            array(
                'type'=>'js',
                'file'=>'assets/admin/libs/jquery-nestable/jquery.nestable'
            )
        );
        $this->addScripts($scriptsAdd);
        $this->writeScripts();

        $model = new Menus;
        $language = Languages::model()->findByPk($id);
        $pages = Pages::model()->findAllByAttributes(array('status'=>1, 'language'=>$id));

        if(isset($_POST['menu_order'])){
            $items = json_decode($_POST['menu_order']);

            if(count($items) > 0){
                $model->menu = "Menu Principal - ".$language->name;
                $model->language = $language->id_language;

                if($model->save()){
                    foreach ($items as $key => $item) {
                        $this->createItem($model->id_menu, $item);
                    }
                }

                $this->redirect(array('admin'));
            }
        }

        $this->render('create',array(
            'model'=>$model,
            'language'=>$language,
            'pages'=>$pages,
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
                'type'=>'css',
                'file'=>'assets/admin/libs/jquery-nestable/jquery.nestable'
            ),
            array(
                'type'=>'js',
                'file'=>'assets/admin/libs/jquery-nestable/jquery.nestable'
            )
        );
        $this->addScripts($scriptsAdd);
        $this->writeScripts();

        $language = Languages::model()->findByPk($id);
        $model = Menus::model()->findByAttributes(array('language'=>$language->id_language));
        $pages = Pages::model()->findAllByAttributes(array('status'=>1, 'language'=>$id));

        if(isset($_POST['menu_order'])){
            $items = json_decode($_POST['menu_order']);

            $currentItems = MenuItems::model()->findAllByAttributes(array('menu'=>$model->id_menu), array('order'=>'t.node DESC'));
            foreach ($currentItems as $key => $item) {
                $item->delete();
            }

            if($model->save()){
                foreach ($items as $key => $item) {
                    $this->createItem($model->id_menu, $item);
                }
            }

            $this->redirect(array('admin'));
        }

        $this->render('update',array(
            'model'=>$model,
            'language'=>$language,
            'pages'=>$pages,
        ));
    }

    private function createItem($menu, $item, $node=null){
        $page = Pages::model()->findByPk($item->id);
        if($page == null){
            $page = new Pages;
            $page->title = $item->id;
        }

        $newItem = new MenuItems;
        $newItem->name = $page->title;
        $newItem->menu = $menu;
        $newItem->page = $page->id_page;
        if($node != null)
            $newItem->node = $node;

        if($newItem->save()){
            if(isset($item->children)){
                foreach ($item->children as $key => $children) {
                    $this->createItem($menu, $children, $newItem->id_item);
                }
            }
        }
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionDelete_menu($id)
    {
        $menus = Menus::model()->findAll();

        if(count($menus) > 1){
            $menu = Menus::model()->findByAttributes(array('language'=>$id));
            $items = MenuItems::model()->findAllByAttributes(array('menu'=>$menu->id_menu), array('order'=>'t.node DESC'));
            foreach ($items as $key => $item) {
                $item->delete();
            }
            $menu->delete();

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
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('Menus');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Menus the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=Menus::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Menus $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='menus-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}