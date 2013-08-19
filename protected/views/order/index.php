<div id="content_basket">
    <div class="img_header"><img src="/img/h_vasha.gif"/></div>

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'basket-form1',
    )); ?>
        <table cellspacing="0">
            <tr><th>Вы выбрали</th><th class="price">Цена</th><th class="count">Кол-во</th><th class="sum">Сумма</th><th class="del"></th></tr>
            <?php if(!empty($basket)):?>
                <?php foreach($basket as $product):?>
                    <? $counter++ ?>
                    <tr class="<?=$counter%2?'color':''?>" data-id="<?=$product['id'];?>">
                        <td><?php echo $product['Name'].' '.$product['CountIn'].'x'.$product['Size']?></td>
                        <td class="price"><span><?=$product['Price']?></span> Р</td>
                        <td class="count"><span><?=CHtml::textField('Basket['.$product['id'].'][Count]',$product['Count'])?></span></td>
                        <td class="sum"><span><?=round($product['Count']*$product['Price'])?></span> Р</td>
                        <td class="del"><a href="#">X</a></td>
                    </tr>
                <?php endforeach;?>
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
                    <td><?php echo isset($bonus['Bonus'])?$bonus['Bonus']:'';?></td>
                    <td class="price">бесплатно</td>
                    <td class="count"></td>
                    <td class="sum" colspan="2">бесплатно</td>
                </tr>
            <?php endif;?>
            <? $counter++ ?>
            <tr class="delivery <?=$counter%2?'color':''?>">
                <td>Доставка</td>
                <td class="price"><span>0</span> Р</td>
                <td class="count"><span>0</span></td>
                <td class="sum" colspan="2"><span>0</span> Р</td>
            </tr>
            <? $counter++ ?>
            <tr class="<?=$counter%2?'color':''?>">
                <td class="back">Промо-код</td>
                <td class="price"></td>
                <td colspan="3" class="sum"><?= CHtml::textField('promo',isset($order['Discount'])?$order['Discount']['Promo']:'')?></td>
            </tr>
            <?php if(isset($order['Discount']['Discount'])&&$order['Discount']['Discount'] > 0):?>
                <? $counter++ ?>
                <tr class="<?=$counter%2?'color':''?>">
                    <td>Скидка <?php echo $order['Discount']['Discount'];?>%</td>
                    <td  class="price"><span>-<?php echo round($order['discountSum']);?></span> Р</td>
                    <td class="count"><span>1</span></td>
                    <td  class="sum" colspan="2"><span>-<?php echo round($order['discountSum']);?></span> Р</td>
                </tr>
            <?php endif;?>
            <tr class="result">
                <td class="back"><a href="#">Вернуться в магазин</a></td>
                <td class="price"><input type="submit" value="Пересчитать"/></td>
                <td colspan="3" class="sum">Общая сумма: <span><?=$order['totalSum'];?></span> Р</td>
            </tr>
        </table>
    <?php $this->endWidget();?>

    <div class="img_header"><img src="/img/h_dostavka.gif"/></div>

    <form method="post">


        <div class="dostavka_block">
            <?php if(!empty($delivery)):?>
                <?php foreach($delivery as $value):?>
                <div class="dostavka_item delivery" data-id="<?= $value->id;?>" data-type="<?= $value->Type;?>" data-price="<?= round($value->Price)?>">
                    <input type="radio" name="delivery" value="<?= $value->id;?>"/><span><?= $value->Name?></span><br/>
                    <?= $value->Instruction;?>
                </div>
                <?php endforeach;?>
            <?php endif;?>
        </div>


        <div class="img_header"><img src="/img/h_oplata.gif"/></div>

        <div class="payments">
            <?php if(!empty($delivery)):?>
                <?php foreach($delivery as $value):?>
                    <?php if(!empty($value->payment_api)):?>
                        <div class="dostavka_block payment-select">
                                <?php foreach($value->payment_api as $deliverypayment):?>
                                <div class="dostavka_item payment" data-id="<?= $deliverypayment->id;?>">
                                    <input type="radio" name="payment" value="<?= $deliverypayment->id;?>" data-id="<?= $deliverypayment->id;?>" /><span><?= $deliverypayment->Name?></span><br/>
                                    <?= $deliverypayment->ShortDescription;?>
                                </div>
                                <?php endforeach;?>
                        </div>
                    <?php endif;?>
                <?php endforeach;?>
            <?php endif;?>
        </div>
    </form>
        <div class="img_header"><img src="/img/h_dannue.gif"/></div>
        <div class="tabs order-form">
            <div class="tab">
                <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'order-form1',
                    'enableAjaxValidation'=>true,
                    'clientOptions' => array(
                        'validateOnSubmit'=>true,
                        'validateOnChange'=>true,
                        'validateOnType'=>false,
                    ),
                )); ?>
                <div class="form_title">
                    <span>Заполните данные для доставки заказа.</span>
                </div>

               <?php echo $form->hiddenField($model,'typeDelivery',array('value'=>1));?>
                <div class="form_item">
                    <div class="form_l">Ваш e-mail: </div>
                    <div class="form_f"><?php echo $form->textField($model,'email'); ?></div>
                    <div class="form_s"></div>
                    <?php echo $form->error($model,'email'); ?>
                </div>

                <div class="form_item">
                    <div class="form_l" id="change_fio">Полное ФИО:<span>Например: Иванов Павел Олегович </span></div>
                    <div class="form_f"><?php echo $form->textField($model,'fullName'); ?></div>
                    <div class="form_s">*</div>
                    <?php echo $form->error($model,'fullName'); ?>
                </div>


                <div class="form_area">
                    <div class="form_l">Город, область*:<span>Например: г. Москва Московская обл.</span> </div>
                    <div class="form_f"><?php echo $form->textField($model,'cityRegion'); ?></div>
                    <div class="form_s">*</div>
                    <?php echo $form->error($model,'cityRegion'); ?>
                </div>
                <div class="form_area">
                    <div class="form_l">Индекс <span>Например: 180000</span> </div>
                    <div class="form_f"><?php echo $form->textField($model,'index'); ?></div>
                    <div class="form_s">*</div>
                    <?php echo $form->error($model,'index'); ?>
                </div>
                <div class="form_area">
                    <div class="form_l" id="change_address">Адрес <span>Например:ул. Ленина 1, кв. 47</span></div>
                    <div class="form_f"><?php echo $form->textField($model,'address'); ?></div>
                    <div class="form_s">*</div>
                    <?php echo $form->error($model,'address'); ?>
                </div>
                <div class="form_item">
                    <div class="form_l">Контактный телефон:<span>Например: +7 916 123-45-67</span> </div>
                    <div class="form_f"><?php echo $form->textField($model,'phone'); ?></div>
                    <div class="form_s">*</div>
                    <?php echo $form->error($model,'phone'); ?>
                </div>

                <div class="form_comment">Ваш комментарий:
                    <?php echo $form->textArea($model,'comment'); ?>
                    <?php echo $form->error($model,'comment'); ?>
                </div>

                <div class="form_end">Поля помеченные звездочкой (<span>*</span>) обязательны для заполнения.</div>
                <input type="submit" value="Отправить"/>
                <?php $this->endWidget();?>
            </div>
            <div class="tab">
                <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'order-form2',
                    'enableAjaxValidation'=>true,
                    'clientOptions' => array(
                        'validateOnSubmit'=>true,
                        'validateOnChange'=>true,
                        'validateOnType'=>false,
                    ),
                )); ?>
                <div class="form_title">
                    <span>Заполните данные для доставки заказа.</span>
                </div>

                <?php echo $form->hiddenField($model,'typeDelivery',array('value'=>2));?>
                <div class="form_item">
                    <div class="form_l" id="change_fio">Имя:<span>Например: Иванов Павел Олегович </span></div>
                    <div class="form_f"><?php echo $form->textField($model,'fullName'); ?></div>
                    <div class="form_s">*</div>
                    <?php echo $form->error($model,'fullName'); ?>
                </div>
                <div class="form_item">
                    <div class="form_l">Контактный телефон:<span>Например: +7 916 123-45-67</span></div>
                    <div class="form_f"><?php echo $form->textField($model,'phone'); ?></div>
                    <div class="form_s">*</div>
                    <?php echo $form->error($model,'phone'); ?>
                </div>
                <div class="form_item">
                    <div class="form_l">Ваш e-mail: </div>
                    <div class="form_f"><?php echo $form->textField($model,'email'); ?></div>
                    <div class="form_s"></div>
                    <?php echo $form->error($model,'email'); ?>
                </div>
                <div class="form_area">
                    <div class="form_l" id="change_address">Адрес <span>Например:ул. Ленина 1, кв. 47</span></div>
                    <div class="form_f"><?php echo $form->textField($model,'address'); ?></div>
                    <div class="form_s">*</div>
                    <?php echo $form->error($model,'address'); ?>
                </div>
                <div class="form_comment">Ваш комментарий:
                    <?php echo $form->textArea($model,'comment'); ?>
                    <?php echo $form->error($model,'comment'); ?>
                </div>
                <div class="form_end">Поля помеченные звездочкой (<span>*</span>) обязательны для заполнения.</div>
                <input type="submit" value="Отправить"/>
                <?php $this->endWidget();?>
            </div>
        </div>



</div>