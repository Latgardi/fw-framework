<?php
namespace Fw\Core;

use Fw\Traits\Singleton;

class Page
{
    use Singleton;

    private array $page;
    public string $leftLimiter = '{{ ';
    public string $rightLimiter = ' }}';

    public static function addJs(string $src): void
    {
        self::getInstance()->addElement($src, 'js', true);
    }

    public static function addCss(string $link): void
    {
        self::getInstance()->addElement($link, 'css', true);
    }

    public static function addString(string $str): void
    {
        self::getInstance()->addElement($str, 'string', false);
    }

    public function setProperty(string $id, mixed $value): void
    {
        $this->page['properties'][$id] = $value;
    }

    public function getProperty(string $id): mixed
    {
        return $this->page['properties'][$id];
    }

    public function showProperty(string $id): void
    {
        $macros = $this->leftLimiter . (string)($id) . $this->rightLimiter;
        echo "<?={$macros}?>";
    }

    public function getAllReplace(): ?array
    {
        if (!isset($this->page['properties'])) {
            return Null;
        }
        $properties = array();
        foreach ($this->page['properties'] as $id => $value)
        {
            $properties[$this->leftLimiter . $id . $this->rightLimiter] = $value;
        }
        return $properties;
    }

    public function showCss(): void
    {
        $css = $this->page['css'];
        if (!isset($css)) {
            echo "";
        } else {
            foreach ($this->page['css'] as $link) {
                echo "<link rel=\"stylesheet\" href=\"{$link}\">\n";
            }
        }
    }

    public function showJs(): void
    {
        $js = $this->page['js'];
        if (!isset($js)) {
            echo "";
        } else {
            foreach ($this->page['js'] as $src) {
                echo "<script src=\"{$src}\"></script>\n";
            }
        }
    }

    public function showString(): void
    {
        $string = $this->page['string'];
        if (!isset($string)) {
            echo "";
        } else {
            foreach ($string as $str) {
                echo "{$str}\n";
            }
        }
    }
    public function showHead(): void
    {
        $this->showCss();
        $this->showString();
        $this->showJs();
    }

    private function addElement(string $src, string $type, bool $unique): void
    {
        $type = $this->page[$type];
        if (!isset($type)) {
            $type = array();
        }
        if ($unique) {
            $hash = md5($src . $type);
            if (!isset($this->$head['hash'])) {
                $type[$hash] = $src;
            }
        } else {
            $type[] = $src;
        }
    }
}