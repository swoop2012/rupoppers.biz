<?php
/**
 * Created by JetBrains PhpStorm.
 * User: User
 * Date: 11.04.13
 * Time: 13:59
 * To change this template use File | Settings | File Templates.
 */

class ArticleController extends Controller{
    public $layout='nobasket';

    public function actionDetail($id){
        $model = $this->loadModel('Article',$id);
        $this->pageTitle = $model->Title;
        $cs = Yii::app()->clientScript;
        $cs->registerMetaTag($model->Description,'Description' );
        $cs->registerMetaTag($model->Keywords,'Keywords' );
        $this->render('detail',compact('model'));
    }
}