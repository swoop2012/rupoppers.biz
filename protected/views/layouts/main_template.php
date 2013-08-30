<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=Windows-1251"/>
	<title><?php echo $this->pageTitle;?></title>
    <?php Yii::app()->clientScript->registerCoreScript('jquery');?>
	<link rel="stylesheet" type="text/css" href="/css/style.css"/>
	<script src="/js/script.js" type="text/javascript"></script>
	<script type="text/javascript">
	<!--
	window.onload = function() {
		glx_input_checkall({
			fast_order : "fast_order_item"
		}); // INPUTS
	}
	//-->
	</script>

<!--[if lt IE 10]>
<style type="text/css">
#min_height { height:102.1%; }
.block_white input[type="text"], #content_prod .otzuv_form input[type="text"], #content_basket .form_f input[type="text"] { height:23px; padding-top:5px; }
</style>
<![endif]-->
<!--[if lt IE 8]>
<style type="text/css">
#min_height { height:100%; }
</style>
<![endif]-->
<!--[if lt IE 7]>
<style type="text/css">
#middle_block { margin-top:-243px; }
#right_block, #content_block { margin-top:0; }
</style>
<![endif]-->
</head>
<body>
<div id="header"><div id="header_bg"><div id="header_block">
	<!-- ЛОГО //-->
	<div class="logo"><a href="/"><img src="/img/logo.jpg"/></a></div>
	<!-- /ЛОГО //-->
	<!-- ТЕЛЕФОН //-->
	<div class="contact">
                    <?php $wmid = GetArray::getWmid();
                    if (!empty($wmid)):?>
                    <span>Добавочный: <?php echo $wmid;?></span>
                    <?php endif;?>
		<div><?php echo GetArray::getRandomPhone('idWebmaster');?></div>
	</div>
	<!-- /ТЕЛЕФОН //-->
	<!-- НАВИГАЦИЯ //-->
	<div class="navi">
		<a class="current" href="/">Каталог</a>
        <a href="<?php echo $this->createUrl('article/detail',array('id'=>3));?>">Доставка и оплата</a>
        <a href="<?php echo $this->createUrl('article/detail',array('id'=>4));?>">Вопросы-ответы</a>
		<a href="<?php echo $this->createUrl('/site/contact');?>">Контакты</a>
	</div>
	<!-- /НАВИГАЦИЯ //-->
</div></div></div>
<div id="min_height"></div>

<div id="middle_bg">
<div id="middle_block">
	<div id="right_block">
		<!-- КОРЗИНА //-->
        <div id="basketContainer">
            <?php $this->drawBasket();?>

		</div>
		<!-- /КОРЗИНА //-->
		<!-- ЗАКАЗ //-->
	<!--	<div class="block_white">
			<form action="." method="post">
			<div class="title">Быстрый заказ</div>
			<div class="fast_order_item"><input type="radio" name="fast_order" value="1"/> Москва и СПб</div>
			<div class="fast_order_item_selected"><input type="radio" name="fast_order" value="2" checked /> Регионы</div>
			<input type="text" name="" value="" placeholder="Имя"/>
			<input type="text" name="" value="" placeholder="Телефон"/>
			<input type="text" name="" value="" placeholder="Адрес"/>
			<textarea name=""></textarea>
			<input type="submit" value="Отправить заказ"/>
			</form>
		</div>
		//-->
		<!-- /ЗАКАЗ //-->
		<!-- СКИДКИ, ОПЛАТА, ДОСТАВКА //-->
		<!-- <div class="block_red"><div class="block_top"><div class="block_icon">
			<div class="title">Наши<span>Бонусы</span></div>
                <? $bonuses = OfferBonus::model()->findAll();
                if(!empty($bonuses)):?>
                    <? foreach($bonuses as $bonus):?>
                        <p><b><?= $bonus->Bonus?></b><br/>
                            при заказе от <?= $bonus->ConditionSum ?> руб.
                        </p>
                    <? endforeach ?>
                <? endif ?>
		</div></div></div> -->
		<div class="block_blue"><div class="block_top"><div class="block_icon">
			<div class="title">Способы<span>Оплаты</span></div>
			<p>Оплата наличными, при получении.</p>
			<p>Через терминалы QIWI.</p>
			<p>Электронными деньгами. (<span>Яндекс.Деньги</span> и <span>Вебмани</span>)</p>
			<p>Банковским переводом по квитанции.</p>
		</div></div></div>
		<div class="block_brown"><div class="block_top"><div class="block_icon">
			<div class="title">Условия<span>Доставки</span></div>
			<p>Курьером по Москве и Санкт-Петербургу в течение 24-48 - 250 руб.</p>
			<p><span>В регионы России</span> Доставка отправлением 1го класса в течение 7-14 рабочих дней - 250 руб.</p>
			<p>Доставка курьерской службой на Ваш выбор.</p>
		</div></div></div>
		<!-- <div class="block_light">Сделайте заказ до 13 часов текущего дня и получите его уже сегодня.</div> -->
		<!-- /СКИДКИ, ОПЛАТА, ДОСТАВКА //-->
	</div>
	<div id="content_block">
		<!-- КОНТЕНТ //-->

			<!-- ГЛАВНАЯ //-->

			<?php echo $content;?>
		</div>
			<!-- /ГЛАВНАЯ //-->

		<!-- /КОНТЕНТ //-->
		<div style="clear:both;"></div>
	</div>
</div>
</div>

<div id="footer"><div id="footer_bg"><div id="footer_block">
	<!-- КОПИРАЙТ //-->
	<div class="copy">
		<span>&copy; <?php echo date('Y');?> RUPOPPERS.BIZ</span>
		Все права защищены.
	</div>
	<!-- /КОПИРАЙТ //-->
	<!-- ТЕЛЕФОН //-->
	<div class="contact">
		<span><?php echo GetArray::getRandomPhone('idWebmaster');?><br>
		<?php $wmid = GetArray::getWmid();
        if (!empty($wmid)):?>
        Добавочный: <?php echo $wmid;?> &mdash; обязателен<br>
        <?php endif;?>
		<a href="<?php echo $this->createUrl('/site/contact');?>">Все контакты</a>
	</div>
	<!-- /ТЕЛЕФОН //-->
</div></div></div>
</body>
</html>