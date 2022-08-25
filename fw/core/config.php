<?php
namespace Fw\Core;
use const Fw\CONFIG;
include "../config.php";

class Config
{
    public static function get(string $path)
    {
        $values = explode("/", $path);
        try {
            $result = CONFIG[$values[0]][$values[1]] ?? null;
            if (!isset($result)) {
                throw new \Error("Parameter doesn't exist.");
            }
        } catch (\Error $error) {
            echo $error;
        }
        return $result;
    }
}