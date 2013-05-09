<?php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once 'vendor/autoload.php';

$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"), false);

$dbConfiguration = array(
	'driver'   => 'pdo_mysql',
	'user'	   => 'root',
	'password' => 'root',
	'dbname'   => 'restapi',
);

$em = EntityManager::create($dbConfiguration, $config);