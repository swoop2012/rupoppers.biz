<?php
class CheckActive extends CComponent{
    public static function Active($url){
	echo substr_count(Yii::app()->request->url, $url)?'class="active"':'';
    }
}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
