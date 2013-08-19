<?php
class MyUrlRule extends CBaseUrlRule
{
    public $connectionID = 'db';

    private function getName($model,$id)
    {
        $id = (int)$id;
        $model = CActiveRecord::model($model)->findByPk($id,array('select'=>"URL"));
        return $model?$model->URL:false;
    }
    private function getId($model,$name)
    {
        $model = CActiveRecord::model($model)->findByAttributes(array('URL'=>$name),array('select'=>"id"));
        return $model?$model->id:false;
    }
    public function createUrl($manager,$route,$params,$ampersand)
    {
        $route = strtolower($route);
        if($route=='product/index'){
             if (isset($params['id'])){
                 $URL = $this->getName('Product',$params['id']);
                 return GetArray::getSetting('start_link_products').'/'.$URL;
             }else{return false;}
        }

        if($route=='article/detail'){
            if (isset($params['section'])){
                $URL = $this->getName('Article',$params['id']);
                return GetArray::getSetting('start_link_articles').'/'.$URL;
             }else{return false;}
        }

        return false;


    }
    public function parseUrl($manager,$request,$pathInfo,$rawPathInfo)
    {
        
        $name = explode('/', $pathInfo); 
            if(strtolower($name[0])=='site'
                    ||strtolower($name[0])=='order'
                    ||strtolower($name[0])=='basket'
                    ||$name[0]=='admin'){
                return false;
        }
        if(count($name)==2){
        if($name[0]==GetArray::getSetting('start_link_products')){
        $id = $this->getId('Product',$name[1]);
                return '/product/index/id/'.$id;
        }
        if($name[0]==GetArray::getSetting('start_link_articles')){
            $id = $this->getId('Article',$name[1]);
            return '/article/detail/id/'.$id;

        }

     }
         return false;
    }
        
 
}
?>