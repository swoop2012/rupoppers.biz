<?php
class GetArray extends CComponent{
    public static function getCache($table)
    {
	$app = Yii::app();
	$modelName=ucfirst($table);
	$model = $app->cache[$table];

	if($model === false)
	{

	    $model = CActiveRecord::model($modelName)->dbConnection->createCommand()
            ->select('t.*')
            ->from(CActiveRecord::model($modelName)->tableName().' t')
            ->queryAll();
	    $dep = new CGlobalStateCacheDependency('Cache.'.$table);
	    $app->cache->set($table, $model, 86400, $dep);
	}
	return $model;
    }
    public static function getSetting($param){
	$array = self::getCache('settings');
	foreach($array as $value){
	    if($value['Attribute']==$param)
		{
		    return $value['Value'];
		}
	}
	return NULL;
    }
    public static function explode($emails){
        $str = str_replace("\r","",$emails);
        return explode("\n",$str);
    }


    public static function getRandomPhone(){
        $str = self::getSetting('Phones');
        $array = self::explode($str);
        $key = mt_rand(0,count($array)-1);
        if(!empty($array))
            return $array[$key];
        return NULL;
    }

    public static function getWmid(){
        return GetArray::getSetting('Type')==1?GetArray::getSetting('idWebmaster'):Cookie::get('wmid');
    }
}
?>
