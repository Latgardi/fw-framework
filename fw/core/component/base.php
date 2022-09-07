<?php
namespace Fw\Core\Component;

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
        $this->__path = __DIR__;
        $this->template = new Template($id, $template, $this->__path);
        $this->params = $params;
    }

    // заполняет результирующий массив
    abstract public function executeComponent();

    public function addResult(): void
    {
        $this->template->result = $this->result;
        $this->template->params = $this->params;
    }
}
