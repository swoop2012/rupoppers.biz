<div class="page-header">
    <h1>Страницы</h1>
</div>
<table class="table">
    <thead>
    <tr>
        <th>Страница</th>
        <th class="th-1">
            <button class="btn btn-success"  onclick="location.href='<?php echo $this->createUrl('create');?>'">Добавить страницу</button>
        </th>
    </tr>
    </thead>
    <tbody>
    <?php if(!empty($model)):?>
        <?php foreach($model as $value):?>
            <tr>
                <td>
                    <?php echo CHtml::link($value->Name,$this->createUrl('detail',array('id'=>$value->id)),array('class'=>'dom-link'));?>
                </td>
                <td class="td-1">
                    <button class="btn" onclick="location.href='<?php echo $this->createUrl('detail',array('id'=>$value->id));?>'">Редактировать</button>
                    <?php if($value->id>1):?>
                    <button class="btn btn-danger" data-id='<?= $value->id?>'>Удалить</button>
                    <?php endif;?>
                </td>
            </tr>
        <?php endforeach;?>
    <?php endif;?>
    </tbody>
</table>