<?php
namespace Fw\Core;
use Fw\Traits\Singleton;
use Fw\Core\Config;

final class Application
{
    use Singleton;

    private static array $components = [];
    private static $pager = null;
    private static $template = null;
    private static $content = null;

    private function __construct()
    {
        self::$pager = new Page();
        self::$template = Template::getInstance();
    }

    public function header(): void
    {
        self::startBuffer();
        $header = self::$template->getHeader();
        echo $header;
    }

    public function footer()
        // demo
    {
        $footer = self::$template->getFooter();
        echo $footer;
        self::endBuffer();
    }

    public static function endBuffer()
    {
        $content = ob_get_clean();
        $properties = self::$pager->getAllReplace();
        if ($properties) {
            foreach ($properties as $property) {
                foreach ($property as $macros => $value) {
                    $content = str_replace($macros, $value, $content);
                }
            }
        }
        echo $content;
    }

    private static function startBuffer():void
    {
        ob_start();
    }

    private static function restartBuffer(): void
    {
        ob_clean();
    }
}
