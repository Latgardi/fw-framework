<?php
namespace Fw\Core\Component;

use Fw\Core\Application;

abstract class Base
{
    public array $result;
    public string $id;
    public Template $template;
    public array $params;
    public string $__path;

    public function __construct(string $id, string $template, array $params)
    {
        $this->id = $id;
        $this->__path = get_class($this);
        $this->__path = mb_strtolower($this->__path);
        $this->__path = str_replace('_', '.', $this->__path);
        $this->template = new Template($id, $template);
        $this->params = $params;
    }

    // заполняет результирующий массив
    abstract public function executeComponent(): void;

}
