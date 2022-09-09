<?php
namespace Fw\Core;

use Fw\Traits\Singleton;
use Fw\Core\Template as PageTemplate;

final class Application
{
    use Singleton;

    private array $components = [];
    private ?Page $pager = null;
    private ?PageTemplate $template = null;
    private ?string $content = null;
    private ?Request $request = null;
    private ?Server $server = null;
    private ?Config $config = null;

    private function __construct()
    {
        $this->pager = Page::getInstance();
        $this->template = PageTemplate::getInstance();
        $this->request = new Request();
        $this->server = new Server();
        $this->config = new Config();
    }

    public function header(): void
    {
        $this->pager->addString("<meta charset=\"utf-8\">");
        $this->pager->addString("<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">");
        $this->pager->addCss($this->config->get('BOOTSTRAP/CSS/LINK'), $this->config->get('BOOTSTRAP/CSS/ATTRIBUTES'));
        $this->pager->addJs($this->config->get('BOOTSTRAP/JS/LINK'), $this->config->get('BOOTSTRAP/JS/ATTRIBUTES'));
        $this->startBuffer();
        $this->template->getHeader();
    }

    public function footer(): void
    {
        $this->template->getFooter();
        $this->endBuffer();
    }

    public function getRequest(): ?Request
    {
        return $this->request;
    }

    public function getServer(): ?Server
    {
        return $this->server;
    }

    public function includeComponent(string $component, string $template, array $params): void
    {
        $componentName = $this->getComponentName($component);
        $component = new $componentName($component, $template, $params);
        $component->executeComponent();
    }

    public function restartBuffer(): void
    {
        ob_clean();
    }

    public function getComponentName(string $component): string
    {
        $component = explode(':', $component);
        $component[1] = str_replace('.', '_', $component[1]);
        return "Fw\\Components\\" . $component[0] . "\\" . $component[1];
    }

    private function endBuffer(): void
    {
        $content = ob_get_clean();
        $properties = $this->pager->getAllReplace();
        if (isset($properties)) {
            $content = str_replace(array_keys($properties), array_values($properties), $content);
        }
        echo $content;
    }

    private function startBuffer():void
    {
        ob_start();
    }
}