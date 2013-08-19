<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
    <link href="https://fonts.googleapis.com/css?family=Limelight|Flamenco|Federo|Yesteryear|Josefin Sans|Spinnaker|Sansita One|Handlee|Droid Sans|Oswald:400,300,700" media="screen" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" type="text/css" href="/css/styleadmin.css" />
	<link rel="stylesheet" type="text/css" href="/css/common.css" />
    
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<?php Yii::app()->bootstrap->register(); ?>
</head>

<body>
<div class="container">
    <div class="container">
        <div class="row-fluid">
          <span class="span12">
            <div class="navbar">
              <div class="navbar-inner">
                <ul class="nav">
		    <?php if(!Yii::app()->user->isGuest):?>

                  <li data-link="admin-offers" <?php echo CheckActive::Active('/admin/products')?>>
		    <?php echo CHtml::link('Товары',$this->createUrl('/admin/products'));?>
                  </li>
                  <li data-link="admin-articles" <?php echo CheckActive::Active('/admin/article')?>>
                    <?php echo CHtml::link('Страницы',$this->createUrl('/admin/article'));?>
                  </li>
		    <li data-link="admin-settings" <?php echo CheckActive::Active('/admin/settings')?>>
		    <?php echo CHtml::link('Настройки сайта',$this->createUrl('/admin/settings'));?>
                  </li>
	
                  <li>
                    <a href="<?php echo $this->createUrl('/admin/default/logout');?>"> <i class="icon icon-signout"></i> Выход</a>
                  </li>
		    <?php endif;?>
                  
                </ul>
              </div>
            </div>
          </span>
        </div>
      </div>

    <div class="container-fluid well">

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>


    </div><!-- page -->
</div>
</body>
</html>

