<?php
namespace Fw\Core;
use Fw\Traits\Singleton;
use const Fw\CONFIG;
include ROOT_PATH . DIRECTORY_SEPARATOR . "config.php";

class Config
{
    public function get(string $path)
    {
        $values = explode("/", $path);
        $result = null;
        try {
            $result = $this->getValue($values);
        } catch (\Exception $exception) {
            echo $exception;
        }
        return $result;
    }

    private function getValue($values)
    {
        $result = CONFIG[$values[0]] ?? null;
        if (isset($values[1])) {
            for ($i = 1, $iMax = count($values); $i < $iMax; $i++) {
                $result = $result[$values[$i]] ?? null;
            }
        }
        if (!isset($result)) {
            throw new \Exception("Parameter doesn't exist.");
        }
        return $result;
    }
}

