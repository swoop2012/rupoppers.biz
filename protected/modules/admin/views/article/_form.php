<div class="row-fluid">
        <span class="span12">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'article-form',
        )); ?>
            <?php echo $form->errorSummary($model,'<button class="btn close" type="button">x</button><strong>Ошибка!</strong>
Необходимо правильно заполнить поля: ',NULL,array('class'=>'alert alert-error')); ?>
              <div class="control-group">
                  <label class="control-label">ЧПУ адрес</label>
                  <div class="controls">
                      <?php echo $form->textField($model,'URL',array('class'=>'textinput span9'))?>

                  </div>
              </div>

          <div class="control-group">
              <label class="control-label">Заголовок</label>
              <div class="controls">
                  <?php echo $form->textField($model,'Name',array('class'=>'textinput span9'))?>
              </div>
          </div>
          <div class="control-group">
            <label class="control-label">Title</label>
            <div class="controls">
                <?php echo $form->textField($model,'Title',array('class'=>'textinput span9'))?>
            </div>
          </div>
          <div class="control-group">
              <label class="control-label">Keywords</label>
              <div class="controls">
                  <?php echo $form->textArea($model,'Keywords',array('class'=>'span9 span9-1'))?>

              </div>
          </div>
          <div class="control-group">
              <label class="control-label">Description</label>
              <div class="controls">
                  <?php echo $form->textArea($model,'Description',array('class'=>'span9 span9-1'))?>

              </div>
          </div>
          <div class="control-group">
              <label class="control-label">HTML-код</label>
              <div class="controls">
                  <?php echo $form->textArea($model,'Text',array('class'=>'span9 span9-1'))?>

              </div>
          </div>
          <div class="form-actions">
              <button class="btn btn-primary">Сохранить</button>
              <button class="btn" type='button' onclick="history.back();">Вернуться назад</button>
          </div>
        <?php $this->endWidget();?>
        </span>
</div>