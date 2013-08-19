<?php
class Image extends CComponent{
    public static function Check($image){
	$image = file_exists($image)? '/'.$image:'/images/temp/kview.png';
	return $image;
    }
}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
