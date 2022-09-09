<?php
namespace Fw\Core;

use Fw\Core\Config;
use Fw\Traits\Singleton;

class Page
{
    use Singleton;

    public array $page;
    public string $leftLimiter = '{{ ';
    public string $rightLimiter = ' }}';

    public function addJs(string $src, array $attributes = null): void
    {
       $this->addElement($src, 'js', $attributes, true);
    }

    public function addCss(string $link, array $attributes = null): void
    {
        $this->addElement($link, 'css', $attributes, true);
    }

    public function addString(string $str): void
    {
        $this->addElement($str, 'string');
    }

    public static function setProperty(string $id, $value): void
    {
        self::getInstance()->page['properties'][] = [$id => $value];
    }

    public function getProperty(string $id): mixed
    {
        foreach ($this->page['properties'] as $pair) {
            if (array_keys($pair)[0] === $id) {
                return $pair[$id];
            }
        }
        return null;
    }

    public static function showProperty(string $id): void
    {
        $macros = self::getInstance()->leftLimiter . (string)($id) . self::getInstance()->rightLimiter;
        echo $macros;
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

    public static function showCss(): void
    {
        if (!isset(self::getInstance()->page['css'])) {
            echo "";
        } else {
            foreach (self::getInstance()->page['css'] as $css) {
                $link = $css['src'];
                $attributes = $css['attr'];
                echo "<link rel=\"stylesheet\" href=\"{$link}\"";
                foreach ($attributes as $attr => $value) {
                    echo " {$attr}=\"{$value}\"";
                }
                echo ">\n";
            }
        }
    }

    public static function showJs(): void
    {
        if (!isset(self::getInstance()->page['js'])) {
            echo "";
        } else {
            foreach (self::getInstance()->page['js'] as $js) {
                $src = $js['src'];
                $attributes = $js['attr'];
                echo "<script src=\"{$src}\"";
                foreach ($attributes as $attr => $value) {
                    echo " {$attr}=\"{$value}\"";
                }
                echo ">\n";
            }
        }
    }

    public static function showString(): void
    {
        if (!isset(self::getInstance()->page['string'])) {
            echo "";
        } else {
            foreach (self::getInstance()->page['string'] as $str) {
                echo "{$str}\n";
            }
        }
    }
    public static function showHead(): void
    {
        self::showCss();
        self::showString();
        self::showJs();
    }

    private function addElement(string $src, string $type, array $attributes = null, bool $unique = false): void
    {
        if (!isset($this->page[$type])) {
            $this->page[$type] = array();
        }
        if ($unique) {
            $hash = md5($src . $type);
            if (!isset($this->page[$type]['hash'])) {
                $this->page[$type][$hash]['src'] = $src;
                if (isset($attributes)) {
                    foreach ($attributes as $attr => $value) {
                        $this->page[$type][$hash]['attr'][$attr] = $value;
                    }
                }
            }
        } else {
            $this->page[$type][] = $src;
        }
    }
}