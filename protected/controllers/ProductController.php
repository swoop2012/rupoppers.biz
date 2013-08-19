<?php

class ProductController extends Controller
{
	public function filters(){
	    return array(
		'ajaxOnly + addProduct',
	    );
	}
	public function actionIndex($id=NULL)
	{

	    $this->setParams();
        $bonuses = OfferBonus::model()->findAll();
	    $model = $this->loadModelExtRel('Product', array('subproduct'), array('t.id'=>(int)$id));
        $cs = Yii::app()->clientScript;
        $cs->registerMetaTag($model->Description,'Description' );
        $cs->registerMetaTag($model->Keywords, 'Keywords');
        $this->pageTitle = $model->Title;
	    $this->render('index',compact('model','bonuses'));
	}
	public function actionAddProduct(){
	    $id = Yii::app()->request->getPost('id');
	    $value = $this->getSubProduct($id);
	    $value['Count'] = 1;
	    Basket::addProduct($id, $value);
	}
	private function getSubProduct($id){
        $model = $this->loadModelExtRel('SubProduct',array('product'),array('t.id'=>$id));
        return array(
            'id'=>$model->id,
            'Name'=>$model->Name,
            'Price'=>Calculate::getPrice($model->Price,$model->product->UpPrice),
            'CountIn'=>$model->Count,
            'Measure'=>$model->Measure,
            'idProduct'=>$model->idProduct,
            'Size'=>$model->Size
        );

	}
}