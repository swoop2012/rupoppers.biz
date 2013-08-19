<div class="order-page">
<h1>Оформление заказа</h1>

<div class="shipping-select">
    <p>Выберите способ доставки:</p>
    <ul>
        <?php if(!empty($delivery)):?>
        <?php foreach($delivery as $value):?>
        <li>
            <div data-id="<?php echo $value->id;?>" data-type="<?php echo $value->Type;?>">
                <div class="name"><?php echo $value->Name;?></div>
                <div><?php echo $value->Instruction;?></div>
                <div>Стоимость: <?php echo round($value->Price);?><div class="rubl">i</div></div>
            </div>
        </li>
        <?php endforeach;?>
        <?php endif;?>
    </ul>
</div>
<div class="payments">
    <?php if(!empty($delivery)):?>
        <?php foreach($delivery as $value):?>
            <?php if(!empty($value->payment_api)):?>
            <div class="payment-select">
                <p>Выберите способ оплаты:</p>
                <ul>
                <?php foreach($value->payment_api as $deliverypayment):?>
                <li>
                    <div data-id="<?php echo $deliverypayment->id;?>">
                        <div class="name"><?php echo $deliverypayment->Name;?></div>
                        <div><?php echo $deliverypayment->ShortDescription;?></div>
                    </div>
                </li>
                <?php endforeach;?>
                </ul>
            </div>
            <?php endif;?>
        <?php endforeach;?>
    <?php endif;?>

</div>
<div class="payment-selected">
    <div class="payment1">
        <p></p>
    </div>
</div>
<div class="tabs">
    <?php if(!empty($delivery)):?>
        <?php foreach($delivery as $value):?>
            <div class="order-sum">
                <p>Ваш заказ</p>
                <table><tbody>
                <?php if(!empty($basket)):?>
                    <?php foreach($basket as $product):?>
                    <tr>
                        <td class="col1"><?php echo $product['Name'].' '.$product['CountIn'].'x'.$product['Size'].' ('. Calculate::Devide($product['Price'],$product['CountIn']).' р./шт)';?></td>
                        <td class="col2"><?php echo $product['Count'];?>шт</td>
                        <td class="col3"><?php echo round($product['Count']*$product['Price']);?><div class="rubl">i</div></td>
                    </tr>
                    <?php endforeach;?>
                <?php endif;?>
                    <tr>
                        <td>Доставка: <?php echo $value->Name;?></td>
                        <td></td>
                        <td><?php echo Calculate::DiscountDelivery($order['totalSum'],$value->Price,$value->FreeIf);?><div class="rubl">i</div></td>
                    </tr>
                    <?php if(isset($order['Discount']['Discount'])&&$order['Discount']['Discount'] > 0):?>
                    <tr>
                        <td>Скидка <?php echo $order['Discount']['Discount'];?>%</td>
                        <td></td>
                        <td>-<?php echo round($order['discountSum']);?><div class="rubl">i</div></td>
                    </tr>
                    <?php endif;?>
                    <?php if(Order::checkDiscountProduct($order)):?>
                        <tr>
                            <td>Промо-товар: <?php echo $order['Discount']['NameProduct'];?></td>
                            <td></td>
                            <td><?php echo round($order['Discount']['PromoPrice']);?><div class="rubl">i</div></td>
                        </tr>
                    <?php endif;?>
                    <?php if(!empty($bonus)):?>
                        <tr>
                            <td>Бонусный товар:</td>
                            <td></td>
                            <td><?php echo isset($bonus['Bonus'])?$bonus['Bonus']:'';?></td>
                        </tr>
                    <?php endif;?>
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                        <td><b>К оплате</b></td>
                        <td></td>
                        <td><b><?php echo round($order['totalSum']+Calculate::DiscountDelivery($order['totalSum'],$value->Price,$value->FreeIf));?><div class="rubl">i</div></b></td>
                    </tr>
                    </tbody></table>
            </div>
        <?php endforeach;?>
    <?php endif;?>


</div>

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
        <table><tbody>
            <tr>
                <th class="col1">Заполните данные для доставки</th>
                <th></th>
            </tr>
            <?php echo $form->hiddenField($model,'typeDelivery',array('value'=>1));?>
            <tr>
                <td class="col1"><span>Полное ФИО*:</span><?php echo $form->error($model,'fullName'); ?></td>
                <td><?php echo $form->textField($model,'fullName'); ?></td>
            </tr>

            <tr>
                <td class="col1">
                    <span>Номер телефона*:</span>
                    <div>Вам позвонят из службы доставки для подтверждения заказа.</div>
                    <?php echo $form->error($model,'phone'); ?>
                </td>
                <td><?php echo $form->textField($model,'phone'); ?></td>
            </tr>

            <tr>
                <td class="col1">
                    <span>Email:</span>
                    <div>Для информирования о статусе заказа и получения кодов на скидку.</div>
                    <?php echo $form->error($model,'email'); ?>
                </td>
                <td><?php echo $form->textField($model,'email'); ?></td>
            </tr>

            <tr>
                <td class="col1">
                    <span>Город, область*:</span>
                    <?php echo $form->error($model,'cityRegion'); ?>
                </td>
                <td><?php echo $form->textField($model,'cityRegion'); ?></td>
            </tr>

            <tr>
                <td class="col1">
                    <span>Индекс*:</span>
                    <?php echo $form->error($model,'index'); ?>
                </td>
                <td><?php echo $form->textField($model,'index'); ?></td>
            </tr>

            <tr>
                <td class="col1">
                    <span>Адрес*:</span>
                    <div>Например: ул. Ленина 1, кв. 1</div>
                    <?php echo $form->error($model,'address'); ?>
                </td>
                <td><?php echo $form->textField($model,'address'); ?></td>

            </tr>

            <tr>
                <td class="col1">
                    <span>Комментарии к заказу:</span>
                    <?php echo $form->error($model,'comment'); ?>
                </td>
                <td><?php echo $form->textArea($model,'comment',array('cols'=>1,'rows'=>1)); ?></td>
            </tr>
            </tbody></table>
        <div class="block-bottom">
            <p>*Звёздочкой помечены поля,<br/>обязательные для заполнения</p>
            <div><input type="submit" value="Отправить заказ"/></div>
        </div>
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
        <table><tbody>
            <tr>
                <th class="col1">Заполните данные для доставки</th>
                <th></th>
            </tr>
            <?php echo $form->hiddenField($model,'typeDelivery',array('value'=>2));?>
            <tr>
                <td class="col1"><span>Имя*:</span><?php echo $form->error($model,'fullName'); ?></td>
                <td><?php echo $form->textField($model,'fullName'); ?></td>
            </tr>

            <tr>
                <td class="col1">
                    <span>Номер телефона*:</span>
                    <div>Вам позвонят из службы доставки для подтверждения заказа.</div>
                    <?php echo $form->error($model,'phone'); ?>
                </td>
                <td><?php echo $form->textField($model,'phone'); ?></td>
            </tr>

            <tr>
                <td class="col1">
                    <span>Email:</span>
                    <div>Для информирования о статусе заказа и получения кодов на скидку.</div>
                    <?php echo $form->error($model,'email'); ?>
                </td>
                <td><?php echo $form->textField($model,'email'); ?></td>
            </tr>

            <tr>
                <td class="col1">
                    <span>Адрес*:</span>
                    <?php echo $form->error($model,'address'); ?>
                </td>
                <td><?php echo $form->textField($model,'address'); ?></td>

            </tr>

            <tr>
                <td class="col1">
                    <span>Комментарии к заказу:</span>
                    <?php echo $form->error($model,'comment'); ?>
                </td>
                <td><?php echo $form->textArea($model,'comment',array('cols'=>1,'rows'=>1)); ?></td>
            </tr>
            </tbody></table>
        <div class="block-bottom">
            <p>*Звёздочкой помечены поля,<br/>обязательные для заполнения</p>
            <div><input type="submit" value="Отправить заказ"/></div>
        </div>
        <?php $this->endWidget();?>
    </div>
</div>

</div>