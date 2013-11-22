<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/main';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
    protected $domain;
    protected $key;
	public $breadcrumbs=array();
	public function filters()
    {
	    return array(
		    'accessControl', // perform access control for CRUD operations
	    );
    }

    protected function beforeAction($action){
        $this->setAttributes();
        $app = Yii::app();
        if($app->request->isAjaxRequest)
            return parent::beforeAction($action);
        $this->setReferer();
        $subaccountid = Cookie::get('subaccountid');
        $wmid = Cookie::get('wmid');

        $checkCode = $this->getCheckCode();
        $cookie = Cookie::get('siteId');

        if($cookie===$checkCode)
            $type = 2;
        else
        {
            $type = 1;
            Cookie::set('siteId',$checkCode);
        }
        $clearDomain = str_replace('www.','',Yii::app()->request->hostInfo);
        $parsedDomain = parse_url($clearDomain);
        $string = str_replace('.','',$parsedDomain['host']);
        $params = array('type'=>$type,'domain'=>$parsedDomain['host'],'hash'=>md5($string.$this->key));
        if(!empty($subaccountid))
            $params['subaccountid'] = $subaccountid;
        if(!empty($wmid))
            $params['wmid'] = $wmid;
        if(!empty($app->session['referer']))
            $params['referer'] = $app->session['referer'];

        $app->clientScript->registerScript('visit','
        $.ajax({
             url:"'.$this->domain.'/api/setViewExt?'.http_build_query($params).'",
             type:"get",
             dataType: "jsonp", // Notice! JSONP <-- P (lowercase)
             success:function(json){
                if(json.success)
                $.get("'.$this->createUrl('/site/write').'");
             },
             error:function(){
                 alert("Error");
             },
        });
        ',CClientScript::POS_READY);
        return parent::beforeAction($action);
    }


    protected  function sendOrders(){
        $models = OrderCache::model()->findAll();
        if(!empty($models))
            foreach($models as $value){
                $result = Curl::sendJSON($this->domain.'api/writeOrder?key='.$this->key,$value->orderString);
                $promo = CJSON::decode($result);

                if(isset($promo['newPromo']))
                    $value->delete();
            }
    }

    private function getCheckCode(){
        return md5(date('Y-m-d'));
    }

    private function setAttributes(){
        $this->domain = GetArray::getSetting('MainDomain');
        $this->key    = GetArray::getSetting('Key');
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
    
    protected function setParams(){
    Yii::app()->clientScript->registerScript('params','var ajaxParams='.CJavaScript::encode(
	    array(Yii::app()->request->csrfTokenName=>Yii::app()->request->csrfToken)),CClientScript::POS_HEAD);
    }
    
    protected function getFilter($name,$field='Name',$condition=NULL,$params=NULL)
    {
	$criteria = new CDbCriteria;
	$criteria->select='id,'.$field;
	if(!empty($condition))
	    $criteria->addCondition($condition);
	if(!empty($params)) 
	    $criteria->params=$params;
	return CHtml::listData(
				CActiveRecord::model($name)->findAll($criteria),'id',$field
				);
    }

    protected function loadModel($modelName,$id){
	$model = CActiveRecord::model($modelName)->findByPk((int) $id);
	if($model==null)
	    throw new CHttpException(404,'The requested page does not exist.');
	return $model;
    }

    protected function loadModelExt($modelName,$params){
	$model = CActiveRecord::model($modelName)->findByAttributes($params);
	if($model==null)
	    throw new CHttpException(404,'The requested page does not exist.');
	return $model;
    }

    protected function loadModelExtRel($modelName,$relation,$params=NULL){
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

    protected function drawBasket(){
    $sum  = Basket::getTotalSum();
    $count = Basket::getTotalCount();
    $this->renderFile(Yii::getPathOfAlias('application.views.cart._cart').'.php',compact('sum','count'));
    }

    protected function setReferer(){
        $app = Yii::app();

        $app->session['referer'] = isset($app->session['referer'])?$app->session['referer']:$app->request->urlReferrer;
        if(isset($_GET['subaccountid']))
            Cookie::set('subaccountid',(int) $app->request->getParam('subaccountid'),31557600);
        if(isset($_GET['wmid']))
            Cookie::set('wmid',(int) $app->request->getParam('wmid'),31557600);
    }
}