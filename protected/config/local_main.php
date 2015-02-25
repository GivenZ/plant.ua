<?php
return CMap::mergeArray(
    require(dirname(__FILE__).'/main.php'),
    array(
        'components'=>array(
					'db'=>array(
							'connectionString' => 'mysql:host=localhost;dbname=plant',
							'emulatePrepare' => true,
							'username' => 'root',
							'password' => '',
							'charset' => 'utf8',
							'tablePrefix' => 'sz_',
							// включаем профайлер
			        'enableProfiling'=>true,
			        // показываем значения параметров
			        'enableParamLogging' => true,
					),
					'log'=>array(
					    'class'=>'CLogRouter',
					    'routes'=>array(
									array(
					            'class' => 'CEmailLogRoute',
					            'categories' => 'plant',
					            'levels' => CLogger::LEVEL_ERROR,
					            'emails' => array('admin@plant.ru'),
					            'sentFrom' => 'log@plant.ru',
					            'subject' => 'Error at plant.ru',
									),
									array(
											'class'=>'CFileLogRoute',
											'levels'=>'warning',
											'logfile'=>'A',
									),
									array(
											'class'=>'CFileLogRoute',
											'levels'=>'info',
											'logfile'=>'B',
									),
									array(
					            'class' => 'CWebLogRoute',
					            'categories' => 'plant',
					            'levels'=>'profile',
											'showInFireBug' => true,
											'ignoreAjaxInFireBug' => true,
					        ),
									array(
					            // направляем результаты профайлинга в ProfileLogRoute (отображается
					            // внизу страницы)
					            'class'=>'CProfileLogRoute',
					            'levels'=>'profile',
					            'enabled'=>true,
					        ),
					    ),
					),
        ),
		
				'modules'=>array(
						// uncomment the following to enable the Gii tool

						'gii'=>array(
							'class'=>'system.gii.GiiModule',
							'password'=>'admin',
						 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
							'ipFilters'=>array('127.0.0.1', '::1'),
						),
				),
    )
);