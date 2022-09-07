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

    private function __construct()
    {
        $this->pager = Page::getInstance();
        $this->template = PageTemplate::getInstance();
        $this->request = new Request();
        $this->server = new Server();
    }

    public function header(): void
    {
        $this->startBuffer();
        $header = $this->template->getHeader();
        echo $header;
    }

    public function footer(): void
    {
        $footer = $this->template->getFooter();
        echo $footer;
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
        $component = new $componentName['path']($componentName['id'], $template, $params);
        $component->executeComponent();
    }

    public function restartBuffer(): void
    {
        ob_clean();
    }

    private function endBuffer(): void
    {
        $content = ob_get_clean();
        $properties = $this->pager->getAllReplace();
        $content = str_replace(array_keys($properties), array_values($properties), $content);
        echo $content;
    }

    private function startBuffer():void
    {
        ob_start();
    }

    public function getComponentName(string $component): array
    {
        $component = explode(':', $component);
        str_replace('.', '_', $component[1]);
        $path = "\\Fw\\Components\\" . $component[0] . "\\" . $component[1];
        $id = $component[1];
        return array('path' => $path, 'id' => $id);
    }
}