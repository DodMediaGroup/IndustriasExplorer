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
);
