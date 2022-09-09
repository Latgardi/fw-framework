<?php
namespace Fw\Components\Fw;
use Fw\Core\Component\Base;
use Fw\Core\Page;

class Interface_Form extends Base
{
    public function executeComponent(): void
    {
        $this->result = $this->params;
        $this->template->params = $this->result;
        $this->template->render();
    }
}