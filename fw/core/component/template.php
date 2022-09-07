<?php
namespace Fw\Core\Component;

use Fw\Core\Page;

class Template
{
    private string $__path;
    private string $__relativePath;
    private string $id;
    public array $result;
    public array $params;

    public function __construct(string $id, string $template, string $comp_path)
    {
        $this->id = $id;
        $this->__path = $comp_path . DIRECTORY_SEPARATOR . "templates" .
            DIRECTORY_SEPARATOR . $template . DIRECTORY_SEPARATOR;
    }

    public function render(string $page): void
    {
        $fileList = ["./result_modifier.php", "{$page}.php", "./component_epilog.php"];
        foreach ($fileList as $file) {
            if (file_exists($this->__path . $file)) {
                include $this->__path . $file;
            } else {
                if ($file === "{$page}.php") {
                    throw new \Exception("Template doesn't exist.");
                }
            }
        }
        $css = $this->__path . "style.css";
        if (file_exists($css)) {
            Page::addCss($css);
        }
        $js = $this->__path . "script.js";
        if (file_exists($js)) {
            Page::addJs($js);
        }
    }
}
