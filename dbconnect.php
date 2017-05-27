<?php

define('DB_DRIVER', 'mysql');
define('DB_SERVER', 'localhost');
define('DB_SERVER_USERNAME', 'user');
define('DB_SERVER_PASSWORD', 'user');
define('DB_DATABASE', 'data');

$connect=mysqli_connect(DB_SERVER,DB_SERVER_USERNAME,DB_SERVER_PASSWORD,DB_DATABASE);
 
if(mysqli_connect_errno($connect))
{
		echo 'Failed to connect';
}


 
 
 
 
?>
