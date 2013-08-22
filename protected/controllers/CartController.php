<?php
class CartController extends Controller{
    public $layout = 'nobasket';

    public function filters(){
	return array(
	    'ajaxOnly + change',
	);
    }

    public function actionIndex(){
    $this->pageTitle='Корзина';
	$this->setParams();
	$data = Basket::getBasket();
	$this->render('index',compact('data'));
    }

    public function actionChange(){
	$id = Yii::app()->request->getPost('id');
	$sign = Yii::app()->request->getPost('sign');
	if(!empty($id)&&!empty($sign))
	Basket::updateCount($id, $sign);
    }

    public function actionDelete(){
        $id = Yii::app()->request->getPost('id');
        if(!empty($id))
            Basket::deleteProduct($id);
    }
    public function actionClear(){
        Basket::clearBasket();
    }

    public function actionRedraw(){
    $sum  = Basket::getTotalSum();
    $count = Basket::getTotalCount();
	$this->renderPartial('_cart',compact('sum','count'));
    }
}
?>
