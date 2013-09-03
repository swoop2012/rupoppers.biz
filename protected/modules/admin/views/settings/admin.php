<h1>Управление настройкам</h1>

<?php
    Yii::app()->clientScript->registerCss('update_button','
    .btn{
    margin-right:4px;
    }');
    echo CHtml::link('<span class="add">Добавить настройку</span>',$this->createUrl('create'),  // the link for open the dialog
    array('class' => 'update-dialog-create btn')
	);
?>
<?php echo CHtml::ajaxLink('<span class="add">Обновить данные</span>',$this->createUrl('/site/synchronize'),
    array('success'=>'js:function(data){
        if(data.success)
            alert(\'Данные обновлены\');
        else
            {
            alert(\'Данные обновить не удалось\');
            console.log(data.error);
            }
        }',
        'dataType'=>'json'),
    array('class' => 'btn')
);
echo CHtml::ajaxLink('<span class="add">Очистить кэш</span>',$this->createUrl('clearCache'),
    array('success'=>'js:function(data){
        if(data.success)
            alert(\'Кэш очищен\');
        else
            {
            alert(\'Кэш очистить не удалось\');
            }
        }',
        'dataType'=>'json'),
    array('class' => 'btn')
);
?>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'settings-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'Attribute',
		'Description',
		'Value',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{update}',
			'buttons'=>array(
			    'update'=>array(
				'click'=>'updateDialogUpdate'
			    ),
			),
		),
	),
)); ?>
<?php
$this->widget('ext.EUpdateDialog.EUpdateDialog', array(
    'height' => 'auto',
    'resizable' => 'false',
    'width' => 'auto'
));
?>
