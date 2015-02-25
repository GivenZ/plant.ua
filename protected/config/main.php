<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Автоматический прокат',
    'language'=>'ru',

	// preloading 'log' component
	'preload'=>array('log','debug','booster'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        'application.vendors.phpexcel.PHPExcel',
        'application.extensions.*',
	),

	'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'admin',
            'generatorPaths' => array(
                'booster.gii'
            ),
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),

	),

	// application components
	'components'=>array(

        'mutex' => array(
              'class' => 'application.extensions.EMutex',
           ),

        'excel'=>array(
            'class'=>'application.extensions.PHPExcel',
        ),


        'booster' => array(
            'class' => 'ext.booster.components.Booster',
            'responsiveCss' => true,
        ),

        'debug' => array(
            //'class' => 'vendor.zhuravljov.yii2-debug.Yii2Debug', // composer installation
            'class' => 'ext.yii2-debug.Yii2Debug', // manual installation
        ),

		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),

		// uncomment the following to enable URLs in path-format

		'urlManager'=>array(
			'urlFormat'=>'path',
            'showScriptName'=>false,
			'rules'=>array(
                'projects/<project_id:.*?>'=>'profile/index',
                'profiles/<profile_id:.*?>'=>'details/index',
                'list/<profile_id:.*?>'=>'details/list',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),


		// database settings are configured in database.php
		//'db'=>require(dirname(__FILE__).'/database.php'),
        // uncomment the following to use a MySQL database
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=plant',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
            'tablePrefix' => 'sz_',
		),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php'),
);
