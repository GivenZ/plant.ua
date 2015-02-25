<?php

// this contains the application parameters that can be maintained via GUI
return array(
	// this is displayed in the header section
	'title'=>'My Yii Blog',
	// this is used in error pages
	'adminEmail'=>'webmaster@example.com',
	// number of posts displayed per page
	'profilesPerPage'=>10,
	// the copyright information displayed in the footer section
	'copyrightInfo'=>'Copyright &copy; 2009 by My Company.',
	'selectPageCount' => array(
		'10' => '10',
		'20' => '20',
		'30' => '30',
		'50' => '50',
		'100' => '100',
		'500' => '500',
		'1000000' => 'Все',
	),
);
