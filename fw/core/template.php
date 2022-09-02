<?php
namespace Fw\Core;
use Fw\Traits\Singleton;
use Fw\Core\Config;

class Template
{
    use Singleton;

    private static $template = null;
    private static $header = null;
    private static $footer = null;

    private function __construct()
    {
        self::$template = Config::get('TEMPLATE');
        self::$header = self::getPart("header");
        self::$footer = self::getPart("footer");
    }

    public function getHeader()
    {
        return self::$header;
    }

    public function getFooter()
    {
        return self::$footer;
    }

    public static function getPart($part) {
        $fileName = ROOT_PATH . DIRECTORY_SEPARATOR . "templates" .
            DIRECTORY_SEPARATOR . self::$template . DIRECTORY_SEPARATOR .
            $part . ".php";
        if (!file_exists($fileName)) {
            throw new \Error("File doesn't exist.");
        }
        return file_get_contents($fileName);
    }
}

