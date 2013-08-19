<div id="content_main">
<div class="items">
<?php if(!empty($data)):?>
<?php foreach($data as $key=>$value):?>
			<div class="item">
				<?php $image = file_exists($value->PictureMain)?$value->PictureMain:'/images/temp/kview.png';
			echo CHtml::link(CHtml::image($image),$this->createUrl('/product/index',array('id'=>$value->id)));?>
			<?php echo CHtml::link($value->ShortName,$this->createUrl('/product/index',array('id'=>$value->id)),array('title'=>$value->ShortName));?>
				<span><?php echo $value->ShortDescriptionMain;?></span>
				<div class="button">от <?php
                    $price = Calculate::getPrice($value->one_subproduct[0]->Price,$value->UpPrice);
                    echo Calculate::Devide($price,$value->one_subproduct[0]->Count);?> Р<a href="<?php echo $this->createUrl('/product/index',array('id'=>$value->id));?>">Купить</a></div>
			</div>
	<?php endforeach;?>
	<?php endif;?>
	</div>
	</div>
    <?php echo $article?$article->Text:'';?>
