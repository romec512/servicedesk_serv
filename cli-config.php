<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 09/05/2019
 * Time: 22:40
 */

// cli-config.php
require_once "bootstrap.php";

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);
