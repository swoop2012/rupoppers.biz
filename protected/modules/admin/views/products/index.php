<div class="page-header">
    <h1>Товары 
    </h1>
</div>
<?php if($success):?>
<div class="alert alert-success">
    <button type="button" class="btn close">x</button> <?php echo $success?>

</div>
<?php endif;?>

<div class="row-fluid">
    <span class="span12">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'products-form',
    )); ?>
<?php if(!empty($model)):?>
    <?php foreach($model as $value):?>
	<?php $this->renderPartial('_detail_partial',compact('value','form'));?>
    <?php endforeach;?>
<?php endif;?>
        <?php $this->endWidget();?>
    </span>
</div>

