<?php
class MyUrlRule extends CBaseUrlRule
{
    public $connectionID = 'db';
 
    public function createUrl($manager,$route,$params,$ampersand)
    {
        if ($route!=false)
        {
            if (isset($params['controller'], $params['id']))
                return $params['controller'] . '/' . $params['id'];
            else if (isset($params['controler']))
                return $params['controller'];
        }
        return false;  // this rule does not apply
    }
 
    public function parseUrl($manager,$request,$pathInfo,$rawPathInfo)
    {
        if (preg_match('%^(\w+)(/(\w+))?$%', $pathInfo, $matches))
        {
            // check $matches[1] and $matches[3] to see
            // if they match a manufacturer and a model in the database
            // If so, set $_GET['manufacturer'] and/or $_GET['model']
            // and return 'car/index'

            $page = Pages::model()->findByAttributes(array('editable'=>0, 'navigation'=>$matches[1]));
            if($page != null){
                if($page->original == ''){
                    $_GET['controller'] = $page->navigation;
                }
                else{
                    $_GET['controller'] = $page->original0->navigation;
                    Yii::app()->request->cookies['language'] = new CHttpCookie('language', $page->language);
                }

                if(isset($matches[3])){
                    $_GET['id'] = $matches[3];
                    return $_GET['controller']."/view";
                }
                return $_GET['controller'];
            }
        }
        return false;  // this rule does not apply
    }
}