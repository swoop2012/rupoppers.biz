<?php $this->beginContent('//layouts/main_template');?>
<div id="column-left">
<!--    <div id='basket-container'>-->
<!--    --><?php //$this->drawBasket();?>
<!--    </div>-->
    <?php // $this->renderFile(Yii::getPathOfAlias('application.views.layouts.left_column').'.php');?>
</div>

<div id="column-right">
        <?php echo $content; ?>
</div>
<?php $this->endContent();?>