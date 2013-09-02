<?php
class ProductsController extends AdminController
{
    public function actionIndex(){
        $cs = Yii::app()->clientScript;
        $cs->registerScriptFile('/js/jquery.nestable.js');
        $request = Yii::app()->request;
        $cs->registerScript('nestable',"$(function(){
            function convertArray(array){
                var result=[];
                $.each(array,function(index){
                    result[index]=this.id;
                    //$.extend(result,{index:this.id});
                })
                return result;
            }
            function arrayDiff(old,newArray){
                var result = {};
                for(var i=0;i<old.length;i++){
                    if(old[i]!=newArray[i]){
                    var key = old[i]
                    result[i] = newArray[i];
                    }
                }
                return result;
            }
            var updateOutput = function(e)
            {
                var list   = e.length ? e : $(e.target),
                    output = list.data('output');
                    console.log(list);
                if (window.JSON) {
                    output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
                } else {
                    output.val('JSON browser support required for this demo.');
                }
            };
             $('#nestable-menu').on('click', function(e)
            {
                var target = $(e.target),
                    action = target.data('action');
                if (action === 'expand-all') {
                    $('.dd').nestable('expandAll');
                }
                if (action === 'collapse-all') {
                    $('.dd').nestable('collapseAll');
                }
            });

            var nestable =$('#nestable3');
            nestable.nestable();
            var oldOrder =  convertArray(nestable.nestable('serialize'));
            nestable.on('change',function(){
                var newResult = convertArray(nestable.nestable('serialize'));
                $.ajax({
                url:'".$this->createUrl('changePosition')."',
                data:'".$request->csrfTokenName."=".$request->csrfToken."&json='+JSON.stringify(arrayDiff(oldOrder,newResult)),
                success:function(data){
                    $('.alert.alert-success').stop().fadeIn(100).fadeOut(1000);
                },
                type:'POST'
                });
                oldOrder = newResult
            })

        })",CClientScript::POS_HEAD);
        $model = Product::model()->findAll(array('order'=>'t.Position ASC'));
        $this->render('index_position',array(
            'model'=>$model,
        ));
    }

    public function actionChangePosition(){
        if(isset($_POST['json']) && !empty($_POST['json'])){
            $result = CJSON::decode($_POST['json']);
            if(!empty($result)){
                $transaction = Yii::app()->db->beginTransaction();
                foreach($result as $key=>$value)
                    Product::model()->updateByPk($value,array('Position'=>$key));
                try
                {
                    $transaction->commit();
                    Settings::setValue('ChangedPosition',1);
                }
                catch(Exception $e)
                {
                    $transaction->rollback();
                }
            }
        }
    }

    public function actionDetail($id){
        $this->setCloseScript();
        $model = $this->loadModel($id);
        $success = $this->updateModel($model);
        $this->render('detail',array(
            'success'=> ($success ? '<strong>Сохранено</strong>!':0 ),
            'model'=>$model,
        ));
    }

    public function actionIndexAll(){

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
