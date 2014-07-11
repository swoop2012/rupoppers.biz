<?php
class Order extends CComponent{
    public static function clearOrder(){
        return Yii::app()->session['Order']=array();
    }


    public static function getOrder(){
        return Yii::app()->session['Order'];
    }

    public static function setOrder($order){
        Yii::app()->session['Order'] = $order;
    }

    public static function setPromo($discount){
        self::setParam('Discount',$discount);
    }

    public static function setParam($key,$value){
        $order = self::getOrder();
        $order[$key] = $value;
        self::setOrder($order);
    }

    public static function getParam($key){
        $order = self::getOrder();
        return isset($order[$key])?$order[$key]:FALSE;
    }

    public static function calculateTotal(){
        $basket = Basket::getBasket();
        $order  = self::getOrder();
        $sum = 0;
        if(!empty($basket))
            foreach($basket as $value)
            {
                $sum += $value['Count']*$value['Price'];
            }
        if(isset($order['Discount']['Discount']))
        {
            $discount = round($sum*$order['Discount']['Discount']/100);
            self::setParam('discountSum', $discount);
            $sum -= $discount;
        }

        self::setParam('totalSum',$sum);
        if(self::checkDiscountProduct($order))
        {
            $sum += $order['Discount']['PromoPrice'];
            self::setParam('totalSum',$sum);
        }

        return $sum;
    }
    public static function checkDiscountProduct($order){
        if(isset($order['Discount']['NameProduct'])&&isset($order['Discount']['PromoPrice'])&&
            !empty($order['Discount']['NameProduct'])&&!empty($order['Discount']['PromoPrice'])&&
            $order['Discount']['ConditionSum'] < $order['totalSum']
            )
        return true;
        else
        return false;
    }

}