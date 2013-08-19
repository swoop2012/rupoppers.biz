<?php
class CheckEmptyBehavior extends CActiveRecordBehavior
{
	public function checkEmpty(){
	    foreach($this->owner->attributes as $key=>$value)
	    {
		if(!in_array($key,array('id','idProduct','idOffer')))
		    if(trim($value)!==''&&$value)
			return false;
	    }
	    
	    return true;
	    
	}
}
?>
