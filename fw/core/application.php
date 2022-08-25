<?php
namespace Fw\Core;
final class Application
{
    private static array $_components = [];
    private static $pager = null;
    private static ?Application $instance = null;
    private static $template = null;

    private function __construct() {}

    public function getInstance(): Application
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

}