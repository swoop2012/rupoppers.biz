
<?php echo $form->errorSummary($value,'<button class="btn close" type="button">x</button><strong>Ошибка!</strong>
Необходимо правильно заполнить поля: ',NULL,array('class'=>'alert alert-error')); ?>
<div class="control-group">
  <label class="control-label">Название</label>
  <div class="controls">
      <?php echo $form->textField($value,'['.$value->id.']Name',array('class'=>'textinput span9 textinput-1'))?>
  </div>
</div>
<div class="control-group">
    <label class="control-label">Title</label>
    <div class="controls">
        <?php echo $form->textField($value,'['.$value->id.']Title',array('class'=>'textinput span9'))?>
    </div>
</div>
<div class="control-group">
    <div class="controls">
    <label class="checkbox">
	<?php echo $form->checkBox($value,'['.$value->id.']Active');?>
	<span>Показывать на сайте</span>
    </label>
    </div>
</div>
<div class="control-group">
              <label class="control-label">URL</label>
              <div class="controls">
		<?php echo $form->textField($value,'['.$value->id.']URL',array('class'=>'textinput span9'))?>  
              </div>
</div>
<div class="control-group">
    <label class="control-label">Description</label>
    <div class="controls">
    <?php echo $form->textField($value,'['.$value->id.']Description',array('class'=>'textinput span9'))?>  
    
    </div>
</div>
<div class="control-group">
    <label class="control-label">Keywords</label>
    <div class="controls">
    <?php echo $form->textField($value,'['.$value->id.']Keywords',array('class'=>'textinput span9'))?>  
    </div>
</div>
<div class="control-group">
    <label class="control-label">Увеличить цену на</label>
    <div class="controls">
    <?php echo $form->dropDownList($value,'['.$value->id.']UpPrice',array(0=>'0%',5=>'5%',10=>'10%'))?>
    </div>
</div>  
    <div class="control-group">
	<label class="control-label">URL фото по умолчанию</label>
    <label class="checkbox">
        <?php echo $form->checkBox($value,'['.$value->id.']DontChangeImages');?>
        <span>Не синхронизировать фото</span>
    </label>
	<div class="controls">
	    <?php echo $form->textField($value,'['.$value->id.']PictureMain',array('class'=>'textinput','placeholder'=>$value->getAttributeLabel('PictureMain')))?>
	    <?php echo $form->textField($value,'['.$value->id.']PictureProduct1',array('class'=>'textinput','placeholder'=>$value->getAttributeLabel('PictureProduct1')))?>
	    <?php echo $form->textField($value,'['.$value->id.']PictureProduct2',array('class'=>'textinput','placeholder'=>$value->getAttributeLabel('PictureProduct2')))?>
	    <?php echo $form->textField($value,'['.$value->id.']PictureProduct3',array('class'=>'textinput input-medium','placeholder'=>$value->getAttributeLabel('PictureProduct3')))?>
	</div>

    </div>
    <label class="checkbox">
        <?php echo $form->checkBox($value,'['.$value->id.']DontChangeDescriptions');?>
        <span>Не синхронизировать описания</span>
    </label>
      <div class="control-group">
          <?php echo $form->labelEx($value,'ShortDescriptionMain',array('class'=>'control-label'))?>
          <?php echo $form->textArea($value,'['.$value->id.']ShortDescriptionMain',array('class'=>'span9 span9-1'))?>
      </div>
    <div class="control-group">
    <?php echo $form->labelEx($value,'ShortDescription',array('class'=>'control-label'))?>
    <?php echo $form->textArea($value,'['.$value->id.']ShortDescription',array('class'=>'span9 span9-1'))?>
    </div>
    <div class="control-group">
    <?php echo $form->labelEx($value,'MiddleDescription',array('class'=>'control-label'))?>
    <?php echo $form->textArea($value,'['.$value->id.']MiddleDescription',array('class'=>'span9 span9-1'))?>
    </div>
    <div class="control-group">
    <?php echo $form->labelEx($value,'Article',array('class'=>'control-label'))?>
    <?php echo $form->textArea($value,'['.$value->id.']Article',array('class'=>'span9 span9-1'))?>
    </div>
    <div class="controls">
    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
    </div>
