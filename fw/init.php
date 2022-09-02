<?php
use Fw\Core\Application;
session_start();

spl_autoload_register(static function ($class) {
    $filename = mb_strtolower($class);
    $filename = str_replace("\\", DIRECTORY_SEPARATOR, $filename);
    $filename = $_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . $filename . ".php";
    try {
        if (file_exists($filename)) {
            require $filename;
        } else {
            throw new \RuntimeException("Class not found.");
        }
    } catch (RuntimeException $exception) {
        echo $exception;
    }
});

define('ROOT_PATH', __DIR__);
define("CORE_INIT", true);

$app = Application::getInstance();