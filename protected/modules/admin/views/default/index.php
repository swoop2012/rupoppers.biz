<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="ru" />

	<!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?= Yii::app()->getBaseUrl(true); ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?= Yii::app()->getBaseUrl(true); ?>css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?= Yii::app()->getBaseUrl(true); ?>css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?= Yii::app()->getBaseUrl(true); ?>css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?= Yii::app()->getBaseUrl(true); ?>css/form.css" />
        <link rel="shortcut icon" href="<?= Yii::app()->getBaseUrl(true); ?>favicon.ico" />
        <style>
            #admin_form{
                margin-top: 50px
            }
        </style>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
<div class="container" id="page">
    <div style="border: 1px solid #C9E0ED;
        background-image: url(<?php echo Yii::app()->getBaseUrl(true)?>/images/admin.png);
        background-repeat: no-repeat;
        background-position: -15px;
	width: 500px;
        height: 230px;    
	margin: 0 auto;
	margin-top: 50px;
	margin-bottom: 50px;
	padding: 20px 10px 10px 10px;
	text-align: right;
	-moz-border-radius: 5px;
        -webkit-border-radius: 5px;" class="form">

    <?$form=$this->beginWidget('CActiveForm', array(
	'id'=>'admin_form',
        'enableClientValidation'=>true,
	'enableAjaxValidation'=>false,
        'clientOptions'=>array(
		'validateOnSubmit'=>true,
                'validateOnChange'=>false,
                ),
        )); ?>
    <div class="row">
        <b><?=$form->labelEx($model,'Login');?></b><br/>
        <?=$form->textField($model,'Login',array('size'=>20,'maxlength'=>32, 'required'=>'true', 'style'=>'width: 50%;')); ?>
        <?=$form->error($model,'Login'); ?>
    </div>
    <div class="row">
        <b><?=$form->labelEx($model,'Password');?></b><br/>
        <?=$form->passwordField($model,'Password',array('size'=>20,'maxlength'=>32, 'required'=>'true', 'style'=>'width: 50%;')); ?>
        <?=$form->error($model,'Password'); ?>
    </div>
    <div class="row buttons">
		<?php echo CHtml::submitButton('Login'); ?>
    </div>

<?php $this->endWidget(); ?>
    </div>
</div>
</body>
</html>