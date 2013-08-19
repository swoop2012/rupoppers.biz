<?if($count):?>
<div id="basket">
<a href="<?=$this->createUrl('/order/index')?>">Корзина</a>
<p><span><?=$count?></span> товаров, на сумму</p>
<p><span><?=$sum?></span> Р</p>
<a class="button" href="<?=$this->createUrl('/order/index')?>">Оформить</a>
</div>
<?endif?>