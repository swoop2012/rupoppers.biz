<?php
class ProductsController extends AdminController
{
      public function actionIndex(){

	$model = Product::model()->findAll(array('order'=>'t.Position ASC'));
	$success = $this->updateProducts($model);
	$this->render('index',array(
	     'success'=>isset($success)?$success:0,
	     'model'=>$model,
	     ));
    }
    public function loadModel($id)
    {
	    $model=Product::model()->findByPk($id);
	    if($model===null)
		    throw new CHttpException(404,'Запрашиваемая страница не найдена!');
	    return $model;
    }
    public function loadSubProduct($id)
    {
	    $model=  SubProduct::model()->findByPk($id);
	    if($model===null)
		    throw new CHttpException(404,'Запрашиваемая страница не найдена!');
	    return $model;
    }

    protected function updateProducts(&$model){
	if(isset($_POST['Product']))
	{
	    $counter = 0;
	    foreach($model as $value)
	    {
		if(isset($_POST['Product'][$value->id]))
		{
		    $value->attributes = $_POST['Product'][$value->id];
		    if($value->validate()){
			$value->save(false);
		    }
		    else
			$counter++;
		}
		else 
		    continue;
	    }
	    if(!$counter)
	    return '<strong>Сохранено</strong>!';
	    else return false;
	}
    }
   
}
?>
