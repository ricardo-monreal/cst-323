<?php 
define('DBHOST', 'mysql:host=');
define('DBUSER', 'ricardo');
define('DBNAME', 'student');
define('DBPASSWORD', 'gcpTest1DB');


$db_con = mysqli_connect(null, DBUSER, DBPASSWORD, DBNAME, null, "/cloudsql/cst-323-gcp:us-west4:cst-323-gcp-db");
