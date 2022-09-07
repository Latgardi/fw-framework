<?php

namespace Fw\Core;

use Fw\Traits\Singleton;

class Template
{
    use Singleton;

    private ?string $template = null;
    private ?string $header = null;
    private ?string $footer = null;
    private ?Config $config = null;

    private function __construct()
    {
        $this->config = new Config();
        $this->template = $this->config->get('TEMPLATE');
        $this->header = $this->getPart("header");
        $this->footer = $this->getPart("footer");
    }

    public function getHeader(): ?string
    {
        return $this->header;
    }

    public function getFooter(): ?string
    {
        return $this->footer;
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