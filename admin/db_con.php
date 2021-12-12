<?php 
define('DBHOST', 'mysql:host=');
define('DBUSER', 'ricardo');
define('DBNAME', 'student');
define('DBPASSWORD', 'gcpTest1DB');


$db_con = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBNAME);
