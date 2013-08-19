<?php Yii::app()->clientScript->registerScript('lo', '
$("#nav li:first").css("width", "30px");
$("#nav li:first a span img").css("width", "26px").css("height", "26px").css("right", "20px").css("position", "relative");
$("#nav li:last a span img").css("width", "50px").css("height", "50px").css("margin-left", "210px").css("position", "absolute").css("top", "-13px").css("z-index", "9999999");
$("#nav li:last").css("background", "none");
$("#nav-bar").css("margin", "10px 20px");
$("#footer a").css("color", "lime");

/*jQuery("div#logo").mouseenter(
  function () {
    jQuery(this).animate({
        color:"black",
    }, 500 );
});

jQuery("div#logo").mouseleave(function() {
    jQuery(this).animate({
        color:"#0CF",
    }, 500 );
});
*/
'); 
/*Yii::app()->clientScript->registerCss('olo', '
div #logo{
    text-align: center;
    font-size: 30px;
    font-weight: bold;
    color: #0CF;    
    text-shadow: 0 0 0.5em red, 0 0 0.1em black, 0 0 0.3em green
}    
');
 */
  ?>

<?php Yii::app()->clientScript->registerScriptFile('/js/jquery.color.js') ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />

    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        
</head>

<body>

<div class="container" id="page">

    <div id="header">
        <div id="logo"></div>
    </div><!-- header -->

    <div id="mainMbMenu">
        <?php 
        if (Yii::app()->user->checkAccess('Administrator',array(),true))
        $items = array(
			    array('label'=>''),
                            array('label'=>'Настройки Сайта', 'url'=>array(Yii::app()->createUrl('/admin/settings'))),
	                    array('label'=>'Пользователи','items'=>array(
				    array('label'=>'Пользователи','url'=>array(Yii::app()->createUrl('/admin/user'))),
				    array('label'=>'Сообщение пользователям','url'=>array(Yii::app()->createUrl('/admin/message')))
				    ),
				),
			    array('label'=>'Справочники', 'items'=>array(
				array('label'=>'Группы мемов','url'=>array(Yii::app()->createUrl('/admin/category'))),
				
				)
				),	
			    array('label'=>'Теги','url'=>array(Yii::app()->createUrl('/admin/tag'))),
			    array('label'=>'Мемы', 'items'=>array(
				    array('label'=>'Модерация мемов', 'url'=>array(Yii::app()->createUrl('/admin/mem'))),
				    array('label'=>'Официальные мемы', 'url'=>array(Yii::app()->createUrl('/admin/mem/official'))),
				)),
			    array('label'=>'Статистика модерации', 'url'=>array(Yii::app()->createUrl('/admin/statistics/moderation'))),	    
			    array('label'=>'Выход', 'url'=>array(Yii::app()->createUrl('/admin/default/logout'))),
                                    
            );
        if (isset($items))    
        $this->widget('application.modules.'.Yii::app()->controller->module->id.'.extensions.mbmenu.MbMenu',array(
            'items'=>$items,
        )); ?>

    </div><!-- mainmenu -->
    <?php if(isset($this->breadcrumbs)):?>
        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
            'links'=>$this->breadcrumbs,
        )); ?><!-- breadcrumbs -->
    <?php endif?>

    <?php echo $content; ?>

    <div class="clear"></div>

    <div id="footer" style="background-color: #298DCD;border-radius: 10px;-moz-border-radius: 10px;-webkit-border-radius: 10px;-ms-border-radius: 10px;color: white;margin: 10px 20px">
        Created &copy; <?php echo date('Y'); ?> by Apricus R & D Group.<br/>
        All Rights Reserved.<br/>
        <?php echo Yii::powered(); ?>
    </div><!-- footer -->

</div><!-- page -->

</body>
</html>
