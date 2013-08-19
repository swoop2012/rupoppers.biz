<?php
/**
 * Created by JetBrains PhpStorm.
 * User: User
 * Date: 25.03.13
 * Time: 11:11
 * To change this template use File | Settings | File Templates.
 */

class GetGeo extends CComponent{
    public static function getInfo($ip,$key){
        $o = array('charset'=>'utf-8','ip'=> $ip);
        $geo = new Geo($o); // запускаем класс
        return $geo->get_value($key);
    }

}