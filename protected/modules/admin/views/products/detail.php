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
<?php echo $form->errorSummary($model,'<button class="btn close" type="button">x</button><strong>Ошибка!</strong>
Необходимо правильно заполнить поля: ',NULL,array('class'=>'alert alert-error')); ?>
<div class="control-group">
  <label class="control-label">Название</label>
  <div class="controls">
      <?php echo $form->textField($model,'Name',array('class'=>'textinput span9 textinput-1'))?>
  </div>
</div>
<div class="control-group">
    <label class="control-label">Title</label>
    <div class="controls">
        <?php echo $form->textField($model,'Title',array('class'=>'textinput span9'))?>
    </div>
</div>
<div class="control-group">
    <div class="controls">
    <label class="checkbox">
	<?php echo $form->checkBox($model,'Active');?>
	<span>Показывать на сайте</span>
    </label>
    </div>
</div>
<div class="control-group">
              <label class="control-label">URL</label>
              <div class="controls">
		<?php echo $form->textField($model,'URL',array('class'=>'textinput span9'))?>  
              </div>
</div>
<div class="control-group">
    <label class="control-label">Description</label>
    <div class="controls">
    <?php echo $form->textField($model,'Description',array('class'=>'textinput span9'))?>  
    
    </div>
</div>
<div class="control-group">
    <label class="control-label">Keywords</label>
    <div class="controls">
    <?php echo $form->textField($model,'Keywords',array('class'=>'textinput span9'))?>  
    </div>
</div>
<div class="control-group">
    <label class="control-label">Увеличить цену на</label>
    <div class="controls">
    <?php echo $form->dropDownList($model,'UpPrice',array(0=>'0%',5=>'5%',10=>'10%'))?>
    </div>
</div>  
    <div class="control-group">
	<label class="control-label">URL фото по умолчанию</label>
    <label class="checkbox">
        <?php echo $form->checkBox($model,'DontChangeImages');?>
        <span>Не синхронизировать фото</span>
    </label>
	<div class="controls">
	    <?php echo $form->textField($model,'PictureMain',array('class'=>'textinput','placeholder'=>$model->getAttributeLabel('PictureMain')))?>
	    <?php echo $form->textField($model,'PictureProduct1',array('class'=>'textinput','placeholder'=>$model->getAttributeLabel('PictureProduct1')))?>
	    <?php echo $form->textField($model,'PictureProduct2',array('class'=>'textinput','placeholder'=>$model->getAttributeLabel('PictureProduct2')))?>
	    <?php echo $form->textField($model,'PictureProduct3',array('class'=>'textinput input-medium','placeholder'=>$model->getAttributeLabel('PictureProduct3')))?>
	</div>

    </div>
    <label class="checkbox">
        <?php echo $form->checkBox($model,'DontChangeDescriptions');?>
        <span>Не синхронизировать описания</span>
    </label>
      <div class="control-group">
          <?php echo $form->labelEx($model,'ShortDescriptionMain',array('class'=>'control-label'))?>
          <?php echo $form->textArea($model,'ShortDescriptionMain',array('class'=>'span9 span9-1'))?>
      </div>
    <div class="control-group">
    <?php echo $form->labelEx($model,'ShortDescription',array('class'=>'control-label'))?>
    <?php echo $form->textArea($model,'ShortDescription',array('class'=>'span9 span9-1'))?>
    </div>
    <div class="control-group">
    <?php echo $form->labelEx($model,'MiddleDescription',array('class'=>'control-label'))?>
    <?php echo $form->textArea($model,'MiddleDescription',array('class'=>'span9 span9-1'))?>
    </div>
    <div class="control-group">
    <?php echo $form->labelEx($model,'Article',array('class'=>'control-label'))?>
    <?php echo $form->textArea($model,'Article',array('class'=>'span9 span9-1'))?>
    </div>
    <div class="controls">
    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
    </div>


        <?php $this->endWidget();?>
    </span>
</div>

