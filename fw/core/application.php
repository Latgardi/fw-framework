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

}
