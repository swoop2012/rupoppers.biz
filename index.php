<?php
if ( !extension_loaded('pdo_sqlite') ) {
    echo 'Необходимо подключить расширение pdo_sqlite';
    exit;
}
if ( !extension_loaded('curl') ) {
    echo 'Необходимо подключить расширение curl';
    exit;
}
header("Content-type: text/html; charset=utf-8");
// change the following paths if necessary
$yii=dirname(__FILE__).'/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

require_once($yii);
Yii::createWebApplication($config)->run();
