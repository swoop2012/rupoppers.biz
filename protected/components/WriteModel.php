<?php
class WriteModel extends CComponent{
    private $modelArray = array(
	    'products'=>'Product',
	    'subproduct'=>'SubProduct',
	    'payments'=>'OfferPayment',
	    'deliverys'=>'OfferDelivery',
        'bonus'=>'OfferBonus',
	    'payment_api'=>'DeliveryPayment',
        'settings'=>'Settings',
	    );

    private $imagesFields = array(
        'PictureMain','PictureProduct1','PictureProduct2','PictureProduct3'
    );
    private $excludeFields = array(
        //'URL','Description','Keywords',
        'ShortDescriptionMain','ShortDescription','MiddleDescription','Article',
        //'Active','UpPrice',
    );
    public $urls;
    private $ids;
    private $keys;
    private $changedPositions;

    public function __construct(){
        $this->changedPositions = Settings::getValue('ChangedPosition');
    }

    public function WriteArray($array,$modelName=NULL)
    {
	if(!empty($array))
	{
        if(!empty($modelName))
        {
            $delete_ids = NULL;
            $tableName = CActiveRecord::model($modelName)->tableName();
            if(!isset($this->ids[$modelName]))
            $this->ids[$modelName] = $this->getId($tableName);

        }
        foreach($array as $key=>$value){

            if(array_key_exists($key, $this->modelArray)){
                $this->WriteArray($value,$this->modelArray[$key]);
            continue;
            }

            if ($relation = $this->checkArray($value)){
                if(isset($this->modelArray[$relation]))
                    $this->WriteArray($value[$relation],$this->modelArray[$relation]);
            }
	    if(!empty($modelName))
            {
                $this->keys[$modelName][] =$key;
                if(!empty($this->ids[$modelName])&&in_array($key,$this->ids[$modelName]))
                {
                    $updateModel =  new $modelName;
                    $updateModel->updateCacheDependencies();
                    if($modelName!=='Product')
                    CActiveRecord::model($modelName)->updateByPk($key,$value['attributes']);
                    else{
                        $product = self::loadModel($modelName,$key);
                        if($this->compareAttributes($product,$value['attributes']))
                            $product->save(false);
                    }
                }
                else
                {
                $model = new $modelName;
                $model->attributes = $value['attributes'];
                $model->save(false);
                    if($modelName=='Product')
                    {
                        $this->urls[] = $model->PictureMain;
                        $this->urls[] = $model->PictureProduct1;
                        $this->urls[] = $model->PictureProduct2;
                        $this->urls[] = $model->PictureProduct3;
                    }

                }
            }
	    }
	}



    }
    public function getImages(){
        if(isset($this->urls))
        $images = $this->urls;
        else
            return false;
        $this->urls = NULL;
        $site = GetArray::getSetting('MainDomain');
        if(!empty($images))
        for($i = 0; $i < count($images);$i++)
        {
            $urls[$images[$i]] = $site.'/'.$images[$i];
        }

        $results=array();
        $mcurl = new MCurl;
        $mcurl->timeout = 5;
        $mcurl->multigetArray($urls, $results);
        if(!empty($results))
        {
            foreach($results as $key=>$value)
            {
                if($key!=='')
                file_put_contents(Yii::getPathOfAlias('webroot').'/'.$key,$value);
            }
        }
    }
    public function delete(){
        foreach($this->ids as $key=>$value)
        {
            if($key=='Settings') continue;
            $delete_ids=NULL;
            if(isset($this->keys[$key]))
            {
                $delete_ids = array_values(array_diff($value,$this->keys[$key]));
                if(!empty($delete_ids))
                    CActiveRecord::model($key)->deleteByPk($delete_ids);

            }
        }
    }
    private static function checkArray($value){
	if(!empty($value))
	{
	    $keys = array_keys($value);
	    for($i=0;$i<count($keys);$i++)
	    if ( $keys[$i] !=='attributes' )
	    return $keys[$i];
	}
	return false;
    }

    private static function getId($table){
        if($table=='{{settings}}')
            $select = 'Attribute';
        else
            $select = 'id';
	return Yii::app()->db->createCommand()
		->select($select)
		->from($table)
		->queryColumn();
    }

    private function compareAttributes(&$attributes1,$attributes2){
        $flag = false;
        foreach($attributes2 as $key=>$value)
        {
            if(($attributes1->DontChangeDescriptions && in_array($key,$this->excludeFields))||
               ($attributes1->DontChangeImages && in_array($key,$this->imagesFields)))
                continue;
            if($key=='Position'){
                $attributes1->DefaultPosition = $value;
                $flag=true;
                if($this->changedPositions == 1 )
                    continue;
            }

            if($attributes1->{$key}!==$value)
            {
                if(in_array($key,$this->imagesFields))
                {
                    if($attributes1->{$key}!=='')
                        @unlink($attributes1->{$key});
                    $this->urls[]=$value;
                }
                $attributes1->{$key}=$value;
                $flag = true;
            }
            else if(in_array($key,$this->imagesFields)&&!file_exists($attributes1->{$key})){
                $this->urls[]=$value;
            }

        }
        return $flag;
    }

    public static function loadModel($modelName,$id){
        $model = CActiveRecord::model($modelName)->findByPk((int) $id);
        if($model==null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
}
?>