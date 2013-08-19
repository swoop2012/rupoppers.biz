<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Limelight|Flamenco|Federo|Yesteryear|Josefin Sans|Spinnaker|Sansita One|Handlee|Droid Sans|Oswald:400,300,700" media="screen" rel="stylesheet" type="text/css" />
    <!-- Typekit fonts require an account and a kit containing the fonts used. see https://typekit.com/plans for details. <script type="text/javascript" src="//use.typekit.net/YOUR_KIT_ID.js"></script>
  <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
-->
    <title>login</title>
    <?php Yii::app()->bootstrap->register();
    Yii::app()->clientScript->registerCss('login',' body {
   padding-left: 0;
   padding-right: 0;
 }
 .form-horizontal .control-group{
 margin-bottom:10px;
 }
 .container {
   padding: 150px 0px 0px 0px;
 }');?>
</head>

<body>
<div class="container">
    <div class="row-fluid">

        <span class="span12">
        <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'login-form1',
                'enableClientValidation'=>true,
                'htmlOptions'=>array('class'=>'form-horizontal  text-center'),
                'clientOptions'=>array(
                    'validateOnSubmit'=>true,
                ),
            )); ?>
            <div class='control-group'>
                <?php echo $form->textField($model,'username',array('placeholder'=>'Ваш логин','class'=>'textinput pull-center')); ?>
            </div>
            <div class='control-group'>
                <?php echo $form->passwordField($model,'password',array('placeholder'=>'Пароль','class'=>'textinput pull-center')); ?>
            </div>
            <button class="btn btn-primary btn-large pull-center">Войти</button>
            <?php $this->endWidget(); ?>
        </span>

    </div>
</div>
</body>
</html>
