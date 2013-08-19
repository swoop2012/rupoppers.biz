<?php
class Calculate extends CComponent{
    public static  function Devide($number1,$number2){
	if($number2)
	    return round($number1/$number2);
	else
	    return '';
    }

    public static  function DiscountDelivery($totalSum=NULL,$price=NULL,$freeIf=NULL){
        if(empty($freeIf))
            return $price;
        if($totalSum > $freeIf)
            return 0;
        else
            return round($price);
    }
    public static function getPrice($price,$upPrice){
        return round($price + $price*$upPrice/100);
    }
}
?>
