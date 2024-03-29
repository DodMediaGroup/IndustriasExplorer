<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Explorer',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'explorer',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		'explorer_admin',
	),

	// application components
	'components'=>array(

		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),

		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'caseSensitive'=>false,
			'rules'=>array(
				'gii'=>'gii',
				'gii/<controller:\w+>'=>'gii/<controller>',
				'gii/<controller:\w+>/<action:\w+>'=>'gii/<controller>/<action>',

				'explorer_admin'=>'explorer_admin',
				'explorer_admin/<controller:\w+>'=>'explorer_admin/default/<controller>',
				'explorer_admin/<controller:\w+>/<id:\d+>'=>'explorer_admin/<controller>/view',
				'explorer_admin/<controller:\w+>/<action:\w+>'=>'explorer_admin/<controller>/<action>',
				'explorer_admin/<controller:\w+>/<action:\w+>/<id:\d+>'=>'explorer_admin/<controller>/<action>',

				'language/<id:\d>'=>'language/change',

				'customer/<action:\w+>'=>'customer/<action>',
				'customer/<action:\w+>/<id:\w+>'=>'customer/<action>',
				array(
			        'class' => 'application.components.MyUrlRule',
			        'connectionID' => 'db',
			    ),

				'/<id:\w+>'=>'page/view',
			),
		),
		

		// database settings are configured in database.php
		'db'=>require(dirname(__FILE__).'/database.php'),

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
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'sergioa@dodmediagroup.co',
		'contactEmail'=>'secretaria@industriasexplorer.com'
	),
);
