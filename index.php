<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 09/05/2019
 * Time: 15:27
 */
require_once __DIR__ . '/vendor/autoload.php';
include __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/cli-config.php';


preg_match("/\/(\w+)\/(\w+)/", $_SERVER['REQUEST_URI'], $matches);
if(count($matches) == 3) {
    $className = 'Controllers\\'.ucfirst(strtolower($matches[1])) . "Controller";
    $method = "action" . ucfirst(strtolower($matches[2]));
    $class = new $className($entityManager);
    echo $class->$method($_POST);
} else {
    echo "404";
}