<?php
namespace Fw\Core;

class Validator
{
    private string $type;
    private $rule;
    private array $validators;

    public function __construct(string $type, $rule, array $validators = null)
    {
        $this->type = $type;
        $this->rule = $rule;
        if ($type === 'chain') {
            if (isset($validators)) {
                $this->validators = $validators;
            } else {
                throw new \RuntimeException('Chain requires array of validators');
            }
        }
    }

    public function exec($value): bool
    {
        return $this->{$this->type}($value);
    }

    private function chain($value): bool
    {
        foreach ($this->validators as $validator) {
            if (!($validator instanceof self)) {
                throw new \RuntimeException('Incorrect object in chain.');
            }
            if (!$validator->exec($value)) {
                return false;
            }
        }
        return true;
    }

    private function minLength(string $value): bool
    {
        return strlen($value) > $this->rule;
    }

    private function maxLength(string $value): bool
    {
        return strlen($value) < $this->rule;
    }

    private function betweenLength(string $value): bool
    {
        if (!is_array($this->rule) or count($this->rule) != 2) {
            throw new \RuntimeException('Rule for type "betweenLength" must be array of 2.');
        }
        return strlen($value) > $this->rule[0] and strlen($value) < $this->rule[1];
    }

    private function in(array $list): bool
    {
        return in_array($this->rule, $list, true);
    }

    private function isEmail(string $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    private function regexp(string $value): bool
    {
        return preg_match($this->rule, $value);
    }
}
