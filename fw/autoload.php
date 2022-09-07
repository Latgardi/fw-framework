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

function componentAutoloader($class): void
{
    echo 'COMPONENT';
    $filename = mb_strtolower($class);
    $filename = str_replace(array("\\", "_"), array(DIRECTORY_SEPARATOR, "."), $filename);
    $filename = $_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . $filename . DIRECTORY_SEPARATOR . ".class.php";
    try {
        if (file_exists($filename)) {
            require $filename;
        } else throw new Exception('Class not found.');
    } catch (Exception $exception) {
        echo $exception;
    }

}

spl_autoload_register('baseAutoloader');
spl_autoload_register('componentAutoloader');
