<?php

	//db config

	define('db','y_user'); // the db i will be using
	define('host', "localhost");
	define('user','root');
	define('password', '');

	define('MALE',2);
	define('FEMALE',1);

	$DB = mysqli_connect(host,user,password,db); //mysqli connection object

?>