<div class="container">
        <div class="row-fluid">
          <span class="span12">
            <div class="navbar">
              <div class="navbar-inner">
                <ul class="nav">
		  <?php if(!Yii::app()->user->isGuest):?>  
                  <li data-link="main" <?php echo CheckActive::Active('/personal/statistics')?>>
                    <a href="<?php echo $this->createUrl('/personal/statistics');?>">Статистика</a>
                  </li>
                  <li data-link="orders" <?php echo CheckActive::Active('/personal/orders')?>>
                    <a href="<?php echo $this->createUrl('/personal/orders');?>">Заказы</a>
                  </li>
                  <li data-link="promo" <?php echo CheckActive::Active('/promo')?>>
                    <a href="<?php echo $this->createUrl('/promo');?>">Промо</a>
                  </li>
                  <li data-link="payments" <?php echo CheckActive::Active('/personal/payments')?>>
                    <a href="<?php echo $this->createUrl('/personal/payments');?>">Выплаты</a>
                  </li>
                  <li data-link="referals" <?php echo CheckActive::Active('/personal/referals')?>>
                    <a href="<?php echo $this->createUrl('/personal/referals');?>">Рефералы</a>
                  </li>
                  <li data-link="tickets" <?php echo CheckActive::Active('/personal/tickets')?>>
                    <a href="<?php echo $this->createUrl('/personal/tickets');?>">Тикеты</a>
                  </li>
		    <li data-link="profile" <?php echo CheckActive::Active('/personal/profile')?>>
                    <a href="<?php echo $this->createUrl('/personal/profile');?>">Профиль</a>
                  </li>
                  <li>
                    <a href="<?php echo $this->createUrl('/site/logout');?>"> <i class="icon icon-signout"></i> Выход</a>
                  </li>
		    <?php else:?>
		    <li>
                    <a href="<?php echo $this->createUrl('/site/login');?>"> <i class="icon icon-signout"></i> Выход</a>
                  </li>
		    <?php endif;?>
                </ul>
              </div>
            </div>
          </span>
        </div>
</div>