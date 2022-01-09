<?php 
require dirname(__FILE__).'/../vendor/autoload.php';
// Monolog
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

$logger = new Logger('loggin_logger');


$logger->pushHandler(new StreamHandler(dirname(__FILE__).'/app_logs.txt', Logger::INFO));


// logger 
$logger->info('User logged out succesfully');

session_start();
session_destroy();
header('Location: ../index.php');