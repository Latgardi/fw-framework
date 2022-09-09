<?php

namespace Fw\Core;

use Fw\Traits\Singleton;

class Template
{
    use Singleton;

    private ?string $template = null;

    private function __construct()
    {
        $config = new Config();
        $this->template = $config->get('TEMPLATE');
    }

    public function getHeader(): void
    {
        $this->getPart("header");
    }

    public function getFooter(): void
    {
        $this->getPart("footer");
    }

    private function getPart(string $part)
    {
        $fileName = ROOT_PATH . DIRECTORY_SEPARATOR . "templates" .
            DIRECTORY_SEPARATOR . $this->template . DIRECTORY_SEPARATOR .
            $part . ".php";
        if (!file_exists($fileName)) {
            throw new \Error("File doesn't exist.");
        }
        return include $fileName;
    }
}