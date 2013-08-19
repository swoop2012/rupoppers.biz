		<div id="content_prod">
			<div class="item_view">
				<h1><?php echo $model->Name;?></h1>
                <?php echo CHtml::image(Image::Check($model->PictureProduct1));?>
				<div class="info">
			<?php echo $model->ShortDescription;?>
			<?php if(!empty($model->subproduct)):?>
					<div>Купить <?php echo $model->Name;?></div>
					<table cellspacing="0">
			<?php foreach($model->subproduct as $value):?>
			
						<tr class="color" data-id="<?php echo $value->id;?>"><td><?php echo $value->Count;?></b> <?php echo $value->Measure;?> (<?php $price = Calculate::getPrice($value->Price,$model->UpPrice);
						echo Calculate::Devide($price, $value->Count);?>р./шт)*</td><td class="price"><?php
                        
                        echo $price = Calculate::getPrice($value->Price,$model->UpPrice);
                        ?> Р</td><td class="button">
						<?php echo CHtml::link('КУПИТЬ',$this->createUrl('addProduct'),array('class'=>'basket-link button','onclick'=>'scrollWindow()'));?></td></tr>
						<?php // echo CHtml::link('Оформить сразу',$this->createUrl('/order/index'),array('class'=>'order-link'));?>
			<?php endforeach;?>
			<?php endif;?>
			

					</table>
				</div>
			</div>
</div>
			<div class="content_text">
			<?php echo $model->Article;?>
			</div>