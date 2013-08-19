<?php
/**
 * Created by JetBrains PhpStorm.
 * User: User
 * Date: 29.03.13
 * Time: 16:53
 * To change this template use File | Settings | File Templates.
 */
class Cookie
{
    public static function get($name)
    {
        $cookie=Yii::app()->request->cookies[$name];
        if(!$cookie)
            return null;
        return $cookie->value;
    }
    public static function set($name, $value, $expiration=86400)
    {
        $cookie=new CHttpCookie($name,$value);
        $cookie->expire = time()+$expiration;
        Yii::app()->request->cookies[$name]=$cookie;
    }
}