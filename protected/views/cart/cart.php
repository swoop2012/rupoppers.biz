<h3>Корзина</h3>
<div id="left-cart">
    <div class="left-cart-top">
        <a class="cart-close" href="#"></a>
    </div>
    <div class="mini-cart-info">
        <?php $this->renderFile(Yii::getPathOfAlias('application.views.cart._cart').'.php',compact('count','sum'));?>
    </div>
</div>
