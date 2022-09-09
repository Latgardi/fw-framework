<?php
namespace Fw\Core\Component;

use Fw\Core\Application;
use Fw\Core\Page;

class Template
{
    private string $__path;
    private string $__relativePath;
    private string $id;
    public array $params;

    public function __construct(string $id, string $template)
    {
        $this->id = $id;
        $this->__path = Application::getInstance()->getComponentName($this->id) . DIRECTORY_SEPARATOR .
        "templates" . DIRECTORY_SEPARATOR . $template . DIRECTORY_SEPARATOR;
        $this->__path = mb_strtolower($this->__path);
        $this->__path = str_replace(['_', '\\'], ['.', DIRECTORY_SEPARATOR], $this->__path);
    }

    public function render(string $page = 'template'): void
    {
        $fileList = ["./result_modifier.php", "{$page}.php", "./component_epilog.php"];
        foreach ($fileList as $file) {
            if (file_exists($this->__path . $file)) {
                $this->params['ok'] = 'OAIJANAUNAUNA';
                include $this->__path . $file;
            } else {
                if ($file === "{$page}.php") {
                    throw new \Exception("Template doesn't exist.");
                }
            }
        }
        $pager = Page::getInstance();
        $css = $this->__path . "style.css";
        if (file_exists($css)) {
            $pager->addCss($css);
        }
        $js = $this->__path . "script.js";
        if (file_exists($js)) {
            $pager->addJs($js);
        }
    }

    public function generateID($string): int
    {
        $salt = bin2hex(random_bytes(5));
        return crc32($string . $salt);
    }
}
