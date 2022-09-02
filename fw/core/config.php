<?php
namespace Fw\Core;
use Fw\Traits\Singleton;
use const Fw\CONFIG;
include ROOT_PATH . DIRECTORY_SEPARATOR . "config.php";

class Config
{
    use Singleton;

    public static function get(string $path)
    {
        $values = explode("/", $path);
        $values = array_map('mb_strtoupper', $values);
        $result = null;
        try {
            $result = self::getValue($values);
        } catch (\Error $error) {
            echo $error;
        }
        return $result;
    }

    private static function getValue($values)
    {
        $result = CONFIG[$values[0]] ?? null;
        if (isset($values[1])) {
            for ($i = 1, $iMax = count($values); $i < $iMax; $i++) {
                $result = $result[$values[$i]] ?? null;
            }
        }
        if (!isset($result)) {
            throw new \Error("Parameter doesn't exist.");
        }
        return $result;
    }
}