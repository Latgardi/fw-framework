<?php
namespace Fw\Traits;

trait Singleton
{
    private static $instance;

    public static function  getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {}

    private function __clone() {}

    private function __wakeup() {}
}