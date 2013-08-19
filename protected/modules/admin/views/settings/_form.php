<?php
/* @var $this SettingsController */
/* @var $model Settings */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'settings-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля с <span class="required">*</span> обязательны.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Attribute'); ?>
		<?php echo $form->textField($model,'Attribute',array('size'=>30,'maxlength'=>30,'disabled'=>!$model->isNewRecord )); ?>
		<?php echo $form->error($model,'Attribute'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Description'); ?>
		<?php echo $form->textField($model,'Description',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'Description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Value'); ?>
		<?php echo $form->textField($model,'Value',array('size'=>50,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'Value'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'добавить' : 'сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->