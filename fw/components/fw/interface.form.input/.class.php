<?php
namespace Fw\Components\Fw;
use Fw\Core\Component\Base;

class Interface_Form_Input extends Base
{
    public function executeComponent(): void
    {
        $this->result = $this->params;
        $this->template->params = $this->result;
        $this->template->render();
    }
}