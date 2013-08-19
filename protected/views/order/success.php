<div class="img_header"><img src="img/h_spasibo.gif"/></div>

<!-- СПАСИБО //-->
<div id="content_final">
    <div class="text_block">Ваш заказ передан службе доставки. Наш менеджер свяжется с вами в ближайшее время.</div>
    <div class="text_block">
        Заказ № <?php echo $order['orderNumber'];?>
    </div>

    <table cellspacing="0">
        <tr><th>Вы выбрали</th><th class="price">Цена</th><th class="count">Кол-во</th><th class="sum">Сумма</th></tr>
        <?php if(!empty($order['subproducts'])):?>
            <?php foreach($order['subproducts'] as $product):?>
                <? $counter++ ?>
                <tr class="<?=$counter%2?'color':''?>">
                    <td><?php echo $product['Name'].' '.$product['CountIn'].'x'.$product['Size']?></td>
                    <td class="price"><span><?=$product['Price']?></span> Р</td>
                    <td class="count"><span><?=$product['Count']?></span></td>
                    <td class="sum"><span><?=round($product['Count']*$product['Price'])?></span> Р</td>
                </tr>
            <?php endforeach;?>
        <?php endif;?>

        <? $counter++ ?>
        <tr class="<?=$counter%2?'color':''?>">
            <td>Доставка: <?php echo $delivery->Name;?></td>
            <td class="price"><span><?=round($delivery->Price)?></span> Р</td>
            <td class="count"><span>1</span></td>
            <td class="sum"><span><?= Calculate::DiscountDelivery($order['totalSum'],$delivery->Price,$delivery->FreeIf);?></span> Р</td>
        </tr>
        <?php if(isset($order['Discount']['Discount'])):?>
            <? $counter++ ?>
            <tr class="<?=$counter%2?'color':''?>">
                <td>Скидка <?php echo $order['Discount']['Discount'];?>%</td>
                <td></td>
                <td class="count"><span>1</span></td>
                <td class="sum"><span>-<?php echo $order['discountSum']?></span> Р</td>
            </tr>
        <?php endif;?>
        <?php if(Order::checkDiscountProduct($order)):?>
            <? $counter++ ?>
            <tr class="<?=$counter%2?'color':''?>">
                <td>Промо-товар: <?php echo $order['Discount']['NameProduct'];?></td>
                <td class="price"><?php echo round($order['Discount']['PromoPrice']);?> Р</td>
                <td class="count"></td>
                <td class="sum" colspan="2"><?php echo round($order['Discount']['PromoPrice']);?> Р</td>
            </tr>
        <?php endif;?>

        <?php if(!empty($bonus)):?>
            <? $counter++ ?>
            <tr class="<?=$counter%2?'color':''?>">
                <td>Бонусный товар:</td>
                <td></td>
                <td></td>
                <td><?php echo isset($bonus['Bonus'])?$bonus['Bonus']:'';?></td>
            </tr>
        <?php endif;?>
        <tr><td>&nbsp;</td></tr>
        <tr class="result"><td class="back"></td><td class="price"></td><td colspan="3" class="sum">Общая сумма: <span><?php echo ($order['totalSum']+Calculate::DiscountDelivery($order['totalSum'],$delivery->Price,$delivery->FreeIf));?> Р</span></td></tr>
    </table>

    <div class="text_block">
        <h3>Как оплатить <b><?php echo $payment->Name;?></b></h3>
        <?php echo $payment->Description;?>
    </div>
    <div class="text_block">
        <p>Мы доставим ваш заказ: <?php echo $delivery->Name;?></p>
    </div>
    <?php if(!empty($order['newPromo'])):?>
    <div class="text_block">
        <h3>Ваш персональный промо-код: <?php echo $order['newPromo'];?></h3>
        <p>У нас действуют накопительные промо-коды. Уже при следующем заказе указав ваш промо-код вы получите скидку — 5%. После 2-го заказа скидка будет увеличена до — 10%.</p>
    </div>
    <?php endif;?>
    <div class="text_block">
        <p>Полное ФИО: <?php echo $order['form']['fullName'];?><br>
            Номер телефона: <?php echo $order['form']['phone'];?><br>
            E-mail: <?php echo $order['form']['email'];?><br>
            <?php if($order['form']['typeDelivery']==1):?>
                Город, область: <?php echo $order['form']['cityRegion'];?><br>
                Индекс: <?php echo $order['form']['index'];?><br>
            <?php endif;?>
            Адрес: <?php echo $order['form']['address'];?><br>
            Комментарий к заказу: <?php echo $order['form']['comment'];?><br>
        </p>
    </div>
    <div class="text_block">Если вы обнаружили ошибку в заказе, то сообщите нам, по телефонам или через форму обратной связи сайта.</div>

</div>

