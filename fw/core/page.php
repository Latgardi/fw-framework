<?php
namespace Fw\Core;

class Page
{
    private array $page;
    private string $leftLimiter = '{{';
    private string $rightLimiter = '}}';

    public function addJs(string $src): void
    {
        $this->addElement($src, 'js', true);
    }

    public function addCss(string $link): void
    {
        $this->addElement($link, 'css', true);
    }

    public function addString(string $str): void
    {
        $this->addElement($str, 'string', false);
    }

    public function setProperty(string $id, mixed $value): void
    {
        $this->page['properties'][$id] = $value;
    }

    public function getProperty(string $id): mixed
    {
        return $this->page['properties'][$id];
    }

    public function showProperty(string $id): array
    {
        $macros = $this->leftLimiter . (string)($id) . $this->rightLimiter;
        $value = "<?={$this->page['properties']['id']}?>";
        return array($macros => $value);
    }

    public function getAllReplace(): ?array
    {
        if (!isset($this->page['properties'])) {
            return Null;
        }
        $properties = array();
        foreach (array_keys($this->page['properties']) as $id)
        {
            $properties[] = $this->showProperty($id);
        }
        return $properties;
    }

    public function showHead()
    {
        $head = "";
        foreach ($this->page['static'] as $element) {
            if ($element['type'] == 'css') {
                $head .= "<link rel=\"stylesheet\" href=\"{$element}\">\n";
            }
            if ($element['type'] == 'string') {
                $head .= "{$element}\n";
            }
            if ($element['type'] == 'js') {
                $head .= "<script src=\"{$element}\"></script>\n";
            }
        }
        return $head;
    }

    private function addElement(string $src, string $type, bool $unique): void
    {
        $head = $this->page['head'];
        if (!isset($head)) {
            $head = array();
        }
        if ($unique) {
            $hash = md5($src . $type);
            if (!isset($this->$head['hash'])) {
                $head[$hash] = array('src' => $src, 'type' => $type);
            }
        } else {
            $head[] = array('src' => $src, 'type' => $type);
        }

    }
}