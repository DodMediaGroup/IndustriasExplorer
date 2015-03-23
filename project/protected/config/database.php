<?php

// This is the database connection configuration.
return array(
	/*'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',*/
	// uncomment the following lines to use a MySQL database
	
	//DATABASE DEVELOPMENT
	'connectionString' => 'mysql:host=localhost;dbname=bd_explorer',
	'emulatePrepare' => true,
	'username' => 'root',
	'password' => '',
	'charset' => 'utf8',

	/*//DATABASE TEST
	'connectionString' => 'mysql:host=localhost;dbname=dodmedia_bd_explorer',
	'emulatePrepare' => true,
	'username' => 'dodmedia_sergio',
	'password' => ')$f)@J&Iv[I&',
	'charset' => 'utf8',*/

	/*//DATABASE TEST
	'connectionString' => 'mysql:host=localhost;dbname=industri_bd_explorer',
	'emulatePrepare' => true,
	'username' => 'industri_dod',
	'password' => 'TAB@r^{Z^rH?',
	'charset' => 'utf8',*/
);