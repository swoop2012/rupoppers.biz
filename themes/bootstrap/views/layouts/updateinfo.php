<?php $this->beginContent('//layouts/mainpersonal'); ?>
<div class="container">
<?php $this->renderFile(Yii::getPathOfAlias('webroot.themes.bootstrap.views.navigation').'.php');?>
<?php echo $content; ?>
</div>
<?php $this->endContent();?>
