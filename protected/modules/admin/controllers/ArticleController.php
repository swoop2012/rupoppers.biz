<?php

class ArticleController extends CrudController
{
    function init() {
        parent::init("article");
        $this->setModel('Article');

    }
	public function actionIndex()
	{

        $model = Article::model()->findAll();
        $this->setScript('.btn.btn-danger',$this->createUrl('delete'));
		$this->render('index',compact('model'));
	}
    public function actionDetail($id)
    {
        $model = $this->loadModel($id);
        if($this->updateModel($model))
            $this->redirect($this->createUrl('index'));
        $this->render('detail',compact('model'));
    }
    public function actionCreate()
    {
        $model = new Article();
        if($this->writeNewModel($model))
            $this->redirect($this->createUrl('index'));
        $this->render('create',compact('model'));
    }
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();
        $this->redirect($this->createUrl('index'));
    }
}