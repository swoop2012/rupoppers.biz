<?php

class DefaultController extends AdminController
{
    public function accessRules()
    {
    return array(
	    // Разрешаем анонимным пользователям действие "авторизация"
	    array('allow',
		    'actions' => array('login', 'error'),
		    'users' => array('?'),
	    ),

	    // запрещаем аутентифицированным пользователям действие "авторизация"
//	    array('deny',
//		    'actions' => array('login'),
//		    'users' => array('@'),
//	    ),
		    array('allow',
		     'users' => array('@'),
	    ),
	    // запрещаем анонимным пользователям все действия
	    array('deny',
		    'users' => array('*'),
	    ),
    );            
    }
        public function actionWelcome()
    {
            
        
        $this->render('welcome');
    }    
    public function actionChangePos()
    {
    $this->ChangePos();
    }
        
    public function actionLogin()
    {
        $this->layout='//';
	    if(!Yii::app()->user->isGuest)
		$this->redirect ($this->createUrl('/admin/products'));
	    $model=new LoginForm;

	    // if it is ajax validation request
	    if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
	    {
		    echo CActiveForm::validate($model);
		    Yii::app()->end();
	    }

	    // collect user input data
	    if(isset($_POST['LoginForm']))
	    {
		    $model->attributes=$_POST['LoginForm'];
		    // validate user input and redirect to the previous page if valid
		    if($model->validate() && $model->login())
			    $this->redirect ($this->createUrl('/admin/products'));
			    //$this->redirect(Yii::app()->user->returnUrl);
	    }
	    // display the login form
	    $this->render('login',array('model'=>$model));
    }

    public function actionLogout(){
        Yii::app()->user->logout(false);
        $this->redirect(Yii::app()->getModule('admin')->user->loginUrl);
    }
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

}
