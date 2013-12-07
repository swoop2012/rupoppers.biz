<?php

/**
 * Description of AdminController
 *
 * @author peter
 */
class AdminController extends CController{
	public $menu=array();
	public $breadcrumbs=array();
        public $layout='mainadmin';
        public $js = "";
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}
        
	public function accessRules()
	{
        return array(
                array('allow',
                         'users' => array('@'),
                ),
                array('deny',
                        'users' => array('*'),
                ),
        );            
	}
        
        public function getModuleId(){
            return 'admin';
        }

        public function getFlashMeesage($key = '', $default = 'Ошибка. Запись не найдена', $drop = true){
            
            return ( Yii::app()->user->hasFlash( $key ) ) ? Yii::app()->user->getFlash($key, $default, $drop) : $default;
        }
        
        public function getProp($size = array()){
            if($size[0]>800 && $size[0]>$size[1]){$width = 800; $height = 0;}
            if($size[1]>600 && $size[1]>$size[0]){$width = 0; $height = 600;}
            return array('w'=>$width, 'h'=>$height);
        }
        
        public function getExtension($filename) {
             return end(explode(".", $filename));
          }    
          
       public function getImgExtArray(){
           return array('jpg', 'png', 'gif');
       }
       
        public function moveRecord($tb, $id, $move, $paramStr = null,$field='Position') {
            if(Yii::app()->request->isAjaxRequest){
                $arrow = ($move != 'up') ? '<' : '>' ;
                $order = ($move != 'up') ? 'DESC' : 'ASC'  ;                
                $connect = Yii::app()->db;
                $now = $connect->createCommand('SELECT `'.$field.'` FROM '.$tb.' WHERE id = '.$id.$paramStr);
                $nowPos = $now->queryRow();
                        
                $any = $connect->createCommand('SELECT `id`,`'.$field.'` FROM '.$tb.' WHERE '.$field.$arrow.$nowPos[$field].' ORDER BY '.$field.' '.$order.' LIMIT 1');
                $anyPos = $any->queryRow();
                if($anyPos==false) {echo 'limit';Yii::app()->end();}

                $nowPosition    = $nowPos[$field];unset($nowPos);
                $futurePosition = $anyPos[$field];$futureId = $anyPos['id'];unset($anyPos);
                
                $step1 = $connect->createCommand('UPDATE '.$tb.' SET `'.$field.'` = '.$futurePosition.' WHERE id = '.$id);
                $step1->query();

                $step2 = $connect->createCommand('UPDATE '.$tb.' SET `'.$field.'` = '.$nowPosition.' WHERE id = '.$futureId);
                $step2->query();
            } else { echo '!Ajax'; }
        }       
        
        
        public function moveRecordMoreParams($tb,$id, $move, $condParamName,$field='Position') {
            if(Yii::app()->request->isAjaxRequest){
                $arrow = ($move != 'up') ? '<' : '>' ;
                $order = ($move != 'up') ? 'DESC' : 'ASC'  ;                
                $connect = Yii::app()->db;
                $now = $connect->createCommand('SELECT `'.$condParamName.'`, `'.$field.'` FROM '.$tb.' WHERE id = '.$id);
                $nowPos = $now->queryRow();
                $nowPosition    = $nowPos[$field];$nowCond    = $nowPos[$condParamName];unset($nowPos);
                        
                $any = $connect->createCommand('SELECT `id`, `'.$field.'` FROM '.$tb.' WHERE '.$field.' '.$arrow.$nowPosition.' AND '.$condParamName.' =  '.$nowCond.' ORDER BY '.$field.' '.$order.' LIMIT 1');
                $anyPos = $any->queryRow();
                if($anyPos==false) {echo 'limit';Yii::app()->end();}

                $futurePosition = $anyPos[$field];$futureId = $anyPos['id'];unset($anyPos);
                
                $step1 = $connect->createCommand('UPDATE '.$tb.' SET `'.$field.'` = '.$futurePosition.' WHERE id = '.$id);
                $step1->query();

                $step2 = $connect->createCommand('UPDATE '.$tb.' SET `'.$field.'` = '.$nowPosition.' WHERE id = '.$futureId);
                $step2->query();
            } else { echo '!Ajax'; }
        }

        
        protected function upload($folder,$controller)
        {
            $photos = yii::app()->session['photofile'];
            $photo  = $photos[$controller];
            Yii::import("application.modules.admin.extensions.EAjaxUpload.qqFileUploader");
            if($photo!="")
            @unlink($folder.$photo);
            $allowedExtensions = array("jpg","jpeg","gif","png");
            $sizeLimit = 10 * 1024 * 1024;
            $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
            $result = $uploader->handleUpload($folder);
            $photos[$controller] = $result['filename'];
            yii::app()->session['photofile']=$photos;
            $result=htmlspecialchars(json_encode($result), ENT_NOQUOTES);
            echo $result;
        }
        protected function uploadmany($folder,$controller)
        {
            $photos = yii::app()->session['photofile'];
            Yii::import("application.modules.admin.extensions.EAjaxUpload.qqFileUploader");
            $allowedExtensions = array("jpg","jpeg","gif","png");
            $sizeLimit = 10 * 1024 * 1024;
            $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
            $result = $uploader->handleUpload($folder);
            $photos[$controller][] = $result['filename'];
            yii::app()->session['photofile']=$photos;
            $result=htmlspecialchars(json_encode($result), ENT_NOQUOTES);
            echo $result;
        }
        protected function changeName($folder,$photo)
        {
            $pathinfo = pathinfo($photo);     
            $filename = $pathinfo['filename'];
            $ext = $pathinfo['extension'];
                while (file_exists($folder . $filename . '.' . $ext)) 
            {
                $filename .= rand(10, 99);
            }
            return array($filename,$ext);
        }
        protected function resizeImg($folder,$t,$ext,$area)
        {
            Yii::app()->thumb->setThumbsDirectory('/'.$folder);
            Yii::app()->thumb
            ->load($folder.$t.'.'.$ext)
            ->adaptiveResize($area['x'], $area['y'])
            ->save(Yii::app()->params['imgPrefix'].$t.'.'.$ext);             
        }
        protected function deleteFiles($folder,$name)
        {
             @unlink($folder.$name);     
             @unlink($folder.Yii::app()->params['imgPrefix'].$name);     
        }
        protected function mc_encrypt($encrypt, $mc_key) {
             $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND);
             $passcrypt = trim(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $mc_key, trim($encrypt), MCRYPT_MODE_ECB, $iv));
             $encode = base64_encode($passcrypt);
             return $encode;
        }
	protected function getFilter($name,$field='Name')
	{
            return CHtml::listData(
				    CActiveRecord::model($name)->findAll(array('select'=>'id,'.$field)),'id',$field
				    );
        }
	protected function setCloseScript(){
	Yii::app()->clientScript->registerScript('close_error','$(".btn.close").click(function(){
	$(this).parent().hide()
	});
	',CClientScript::POS_END);
	}
	protected function setScript($selector,$url){
	Yii::app()->clientScript->registerScript('delete'.$url,'
	$("'.$selector.'").bind("click",function(e){
	if(confirm("Вы действительно хотите удалить запись?"))
	$.get("'.$this->createUrl($url).'",{id:$(this).data("id"),
	    '.Yii::app()->request->csrfTokenName .':"'.Yii::app()->request->csrfToken.'"},function(data){
	    window.location.reload();
	    })
	e.preventDefault()
	})
	',CClientScript::POS_END);
    }

    protected function writeNewModel(&$model,$attributes = NULL)
    {
        $modelName = get_class($model);
        if(isset($_POST[$modelName]))
        {
            if(!empty($attributes))
            $model->attributes = $attributes;
            $model->attributes = $_POST[$modelName];

            if($model->save())
            {
                $model = new $modelName;
                return true;
            }

        }
        return false;
    }
    protected function writeNewModels($modelName,$parentField,$attributes=NULL){
        if(isset($_POST[$modelName]))
        {
            if(!empty($_POST[$modelName]))
                $keys = array_keys($_POST[$modelName]);
            foreach($keys as $key)
            {
                if(isset($_POST[$modelName][$key]['new']))
                {
                    $model = new $modelName;
                    $model->$parentField = (int) $key;
                    $model->attributes = $_POST[$modelName][$key]['new'];
                    if(!empty($attributes))
                        $model->attributes = $attributes;
                    if(!$model->checkEmpty())
                        $model->save();
                    unset($model);
                }
            }
        }
    }
    protected function writeNewModelExt(&$model,$attributes = NULL)
    {
        $modelName = get_class($model);
        if(isset($_POST[$modelName]['new']))
        {
            if(!empty($attributes))
                $model->attributes = $attributes;
            //$model->idUser = Yii::app()->user->id;
            $model->attributes = $_POST[$modelName]['new'];

            if($model->save())
            {
                $model = new $modelName;
                return true;
            }

        }
        return false;
    }
    protected function updateModel(&$model)
    {
        $modelName = get_class($model);
        if(isset($_POST[$modelName]))
        {
            $model->attributes = $_POST[$modelName];

            if($model->save())
            {
                return true;
            }

        }
        return false;
    }
    protected function updateAllModels(&$model,$relation,$modelName){
        if(empty($model->{$relation}))
            return 0;
        $counter = 0;
        if(isset($_POST[$modelName]))
        {
            foreach($model->{$relation} as $value)
            {
                if(isset($_POST[$modelName][$value->id]))
                {
                    $value->attributes = $_POST[$modelName][$value->id];
                    if($value->validate()){
                        $value->save(false);
                    }
                    else
                        $counter++;
                }
                else
                    continue;
            }

            return $counter;
        }
    }

    protected function loadModelExt($modelName,$params){
        $model = CActiveRecord::model($modelName)->findByAttributes($params);
        if($model==null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
    protected function loadModelExtRel($modelName,$relation,$params){
        $criteria = new CDbCriteria;
        if(!empty($params))
            foreach($params as $key=>$value)
                $criteria->compare($key,$value);
        $criteria->with =$relation;
        $model = CActiveRecord::model($modelName)->find($criteria);
        if($model==null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
}


