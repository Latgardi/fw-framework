<?php
include "autoload.php";

use Fw\Core\Application;

session_start();

define('ROOT_PATH', __DIR__);
define("CORE_INIT", true);

$app = Application::getInstance();

