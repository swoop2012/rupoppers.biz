<?php

class SiteController extends Controller
{
    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page'=>array(
                'class'=>'CViewAction',
            ),
        );
    }

    public function filters(){
        return array(
            array(
                'application.filters.YXssFilter',
                'clean'   => '*',
                'tags'    => 'strict',
                'actions' => 'contact'
            ),
            'ajaxOnly +setParam,write',
        );
    }
    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {


        $article = Article::model()->findByPk(1);
        $this->pageTitle=$article->Title;
        $cs = Yii::app()->clientScript;
        $cs->registerMetaTag($article->Description,'Description' );
        $cs->registerMetaTag($article->Keywords,'Keywords' );
        $data = Product::model()->findAll(array(
                'order'=>'t.Position','group'=>'t.id','together'=>true,'condition'=>'t.Active=:avaible','params'=>array(':avaible'=>1),
                'with'=>array('one_subproduct'),

            )
        );
        $this->render('index',compact('data','article'));
    }
    public function actionSynchronize($key='')
    {
        $settingsKey = $this->key;
        if(!Yii::app()->user->isGuest || $key == $settingsKey)
        {

            $data = Curl::getContent($this->domain.'/api/offer?key='.$settingsKey);
            //$data = file_get_contents(GetArray::getSetting('MainDomain').'/api/offer?key='.$settingsKey);
            $writeModel = $this->parseData($data);
            if($writeModel)
                echo CJSON::encode(array('success'=>1,'urls'=>$writeModel->urls));
            else
                echo CJSON::encode(array('success'=>0,'error'=>$data));
        }
    }

    public function ActionWrite(){
        $this->sendOrders();
    }




    private function parseData($data){
        $decodedArray  = CJSON::decode($data);
        if(!empty($decodedArray))
        {
            $writeModel = new WriteModel();
            $transaction = Yii::app()->db->beginTransaction();
            $writeModel->WriteArray($decodedArray);
            try
            {

                $transaction->commit();
            }
            catch(Exception $e)
            {
                $transaction->rollback();
            }
            $writeModel->getImages();
            $writeModel->delete();
            return $writeModel;
            //WriteModel::WriteArray ($decodedArray);
        }
        return false;
    }
    /**
     * This is the action to handle external exceptions.
     */
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

    public function actionContact()
    {
        $model=new ContactForm;
        if(isset($_POST['ContactForm']))
        {
            $this->performAjaxValidation($model);
            $model->attributes=$_POST['ContactForm'];
            if($model->validate())
            {
                Yii::app()->user->setFlash('contact','Спасибо что связались с нами! Мы вам скоро ответим.');

                if(GetArray::getSetting('FeedbackFlag'))
                {
                    $headers="From: {$model->email}\r\nReply-To: {$model->email}";
                    mail(GetArray::getSetting('FeedbackEmail'),$model->subject,$model->body,$headers);
                }
                else
                {
                    $request = Yii::app()->request;
                    $city = GetGeo::getInfo($request->userHostAddress,'city');
                    $json = CJSON::encode(array(
                        'ip'=>$request->userHostAddress,
                        'ipCity'=>$city,
                        'email'=>$model->email,
                        'name'=>$model->name,
                        'message'=>$model->body,

                    ));
                    Curl::sendJSON($this->domain.'/api/writeFeedback?key='.$this->key,$json);

                }
                $this->refresh();
            }
        }
        $this->render('contact',array('model'=>$model));
    }
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax'])
            //&& $_POST['ajax'] === 'order-form'
        ) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}