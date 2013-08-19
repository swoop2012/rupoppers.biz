<div class="cart-page">
	<h1>Корзина</h1>
	<div class="cart-products" data-link="/cart/change" data-del-link="/cart/delete">
	    <?php if(!empty($data)):?>
	    <?php foreach ($data as $key=>$value):?>
		<div class="product" data-id="<?php echo $key;?>">
			<table>
				<tr>
					<td class="p-left">
						<a class="name" href="#"><?php echo $value['Name'];?></a>
						<div class="pack"><?php echo $value['CountIn'].' '.$value['Measure']?></div>
					</td>

					<td class="count">
						<a class="plus" href="#"></a>
						<a class="minus" href="#"></a>
						<div><span><?php echo $value['Count'];?></span> шт.</div>
					</td>

					<td class="price">
						<!-- Цена товара --><input type="hidden" value="<?php echo $value['Price'];?>"/>
						<span><?php echo round($value['Price']*$value['Count']);?></span><div class="rubl">i</div>
					</td>
                    <td class="p-right">
                        <a class="delete" href="#"></a>
                    </td>
				</tr>
			</table>
		</div>
	    <?php endforeach;?>
	    <?php endif;?>
	</div>
	<div class="cart-bottom">
        <?php echo CHtml::beginForm(CHTml::normalizeUrl($this->createUrl('/order')));?>

		<div class="block-left">
			<p>После первого заказа вы получите код, дающий скидку 5% на все последующие заказы.</p>
			<div><span>Код на скидку:</span><input name="promo" type="text"/></div>
		</div>

		<div class="block-right">
			<div class="total"><b>Итого: </b><span></span><div class="rubl">i</div></div>

			<input type="submit" value="Оформить заказ"/>
		</div>
        <?php echo CHtml::endForm();?>

		<div class="clr"></div>
	</div>


</div>