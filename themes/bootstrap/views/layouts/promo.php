<?php $this->beginContent('//layouts/mainpersonal'); ?>
<?php $this->renderFile(Yii::getPathOfAlias('webroot.themes.bootstrap.views.navigation').'.php');?>
<?php echo $content; ?>
<?php $this->endContent();?>
