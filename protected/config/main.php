<?php
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'CJ Poppers',
	'language' => 'ru',
    'timeZone'=>'Europe/Moscow',
    // preloading 'log' component
	'preload'=>array('log'),
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		'admin'=>array(
               //'layout'=>'application.modules.admin.views.layouts.column2',
		),
	     'gii'=>array(
		'class'=>'system.gii.GiiModule',
		'password'=>'gii',
		'generatorPaths'=>array(
		    'bootstrap.gii',
		),
	    ),
	),
	'components'=>array(
	     'bootstrap'=>array(
            'class'=>'bootstrap.components.Bootstrap',
	    ),
	    'user'=>array(
			'allowAutoLogin'=>false,
		),
  'request' => array(
            'class' => 'HttpRequest',
            'enableCsrfValidation' => true,
            'noCsrfValidationRoutes' => array(
                 ),
            'csrfTokenName' => 'token',
        ),             
		// uncomment the following to use a MySQL database
		'db' => require(dirname(__FILE__) . '/db.php'),
		'cache'=>array(
		    'class'=>'CDbCache',
		    'connectionID'=>'db',
		),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),

		 'urlManager'=>array(
			'urlFormat'=>'path',
                        'showScriptName'=>false,

			'rules'=>array(
                array(
                    'class' => 'application.components.MyUrlRule',
                    'connectionID' => 'db',
                ),
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                                '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
			),
		),                   
                'thumb'=>array(
                    'class'=>'ext.phpthumb.EasyPhpThumb',
                ),  
	),
    
	'params'=>array(
		'user'=>require(dirname(__FILE__) . '/user.php'),
		'adminEmail'=>'webmaster@example.com',
                'uploadsPaths'=>array(
                                       'img'=>array(
                    'editor'=>'uploads/editor/',
		           ),
                    'files'=>'uploads/files/'
                ),
                'imgSizes'=>array(
                                      

                ),
		
                'photoPrefix'=>'sm_',
            	'imgPrefix'=>'sm_',
		'statusPublished'=>array('Yes'=>'Да','No'=>'Нет'),
		'Active'=>array('Нет','Да'),
		'DeliveryType'=>array('1'=>'Почта','2'=>'Курьер'),
	),
);