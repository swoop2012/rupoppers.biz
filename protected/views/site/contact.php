<div id="content_basket">
<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
    <h1><?php echo Yii::app()->user->getFlash('contact'); ?></h1>
</div>

<?php else: ?>

    <h1>Обратная связь</h1>
    <h2>Не забывайте указывать E-mail, на него будет отправлен ответ на ваше обращение!</h2>

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'contact-form',
        'enableAjaxValidation'=>true,
            'clientOptions' => array(
                'validateOnSubmit'=>true,
                'validateOnChange'=>true,
                'validateOnType'=>false,
            ),
        )); ?>
<?php $this->pageTitle='Написать нам'; ?>
            <div class="form_item">
                <div class="form_l" id="change_fio">Имя:</div>
                <div class="form_f"><?php echo $form->textField($model,'name'); ?></div>
                <div class="form_s">*</div>
                <?php echo $form->error($model,'name'); ?>
            </div>
            <div class="form_item">
                <div class="form_l" id="change_fio">E-mail:*</div>
                <div class="form_f"><?php echo $form->textField($model,'email'); ?></div>
                <div class="form_s">*</div>
                <?php echo $form->error($model,'email'); ?>
            </div>
            <div class="form_item">
                <div class="form_l" id="change_fio">Вопрос:</div>
                <div class="form_f">
                    <?php echo $form->textArea($model,'body',array('rows'=>1, 'cols'=>1)); ?>
                </div>
                <div class="form_s">*</div>
                <?php echo $form->error($model,'body'); ?>
            </div>

        <div class="block-bottom">
            <p>*Звёздочкой помечены поля,<br/>обязательные для заполнения</p>
            <div><input type="submit" value="Отправить"/></div>
        </div>
        <?php $this->endWidget(); ?>


<?php endif; ?>
</div>