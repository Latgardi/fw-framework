<?php
session_start();

spl_autoload_register(static function ($class) {
    $filename = strtolower($class);
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