<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 09/05/2019
 * Time: 17:23
 */

// bootstrap.php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";

// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/Database"), $isDevMode);
// or if you prefer yaml or XML
//$config = Setup::createXMLMetadataConfiguration(array(__DIR__."/config/xml"), $isDevMode);
//$config = Setup::createYAMLMetadataConfiguration(array(__DIR__."/config/yaml"), $isDevMode);

// database configuration parameters
$conn = array(
    'driver' => 'pdo_pgsql',
    'user' => 'service_desk_user',
    'password' => 'urivit05',
    'host' => '127.0.0.1',
    'port' => '5432',
    'dbname' => 'service_desk',
    'charset' => 'UTF-8'
);

// obtaining the entity manager
 $entityManager = EntityManager::create($conn, $config);