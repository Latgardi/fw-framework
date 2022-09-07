<?php
function baseAutoloader($class): void
{
    $filename = mb_strtolower($class);
    $filename = str_replace("\\", DIRECTORY_SEPARATOR, $filename);
    $filename = $_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . $filename . ".php";
    if (file_exists($filename)) {
        require $filename;
    }
}

spl_autoload_register('baseAutoloader');
