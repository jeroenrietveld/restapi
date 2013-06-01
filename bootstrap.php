<?php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Yaml\Yaml;

require_once 'vendor/autoload.php';

$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"), true);

$dbSettings = Yaml::parse(file_get_contents('./config/database.yml'));

$em = EntityManager::create($dbSettings, $config);