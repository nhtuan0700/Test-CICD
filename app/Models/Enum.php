<?php

namespace App\Models;

use Exception;
use ReflectionClass;
use ReflectionClassConstant;

class Enum
{
    /**
     * 定義された const の値に対応する
     * @var mixed
     */
    private mixed $scalar;

    /**
     * 定義された const の変数名に対応する
     * @var string
     */
    private string $label;

    /**
     * @param mixed $value
     * @param string $label
     */
    public function __construct(mixed $value, string $label)
    {
        $ref = new ReflectionClass($this);
        $consts = $ref->getConstants();
        if (!in_array($value, $consts, true)) {
            throw new Exception(static::class . " invalid label:{$label} scalar:{$value} ");
        }
        $this->scalar = $value;
        $this->label = $label;
    }

    /**
     * @return string
     */
    final public function __toString(): string
    {
        return (string)$this->scalar;
    }

    /**
     * get key
     *
     * @return string
     */
    final public function key(): mixed
    {
        return $this->label;
    }

    /**
     * get value
     *
     * @return mixed
     */
    final public function value(): mixed
    {
        return $this->scalar;
    }

    /**
     * execute when attempt to call static not exist
     * 
     */
    final public static function __callStatic($label, $args)
    {
        $class = get_called_class();
        $constValue = constant("$class::$label");
        return new $class($constValue, $label);
    }

    /**
     * キー（const の変数名）を渡すと、Enumを取得するメソッド。
     * @param string $label
     * @return static
     */
    final public static function of(string $label): static
    {
        $class = get_called_class();
        $scalar = constant("$class::$label");
        return new $class($scalar, $label);
    }

    /**
     * @param string $attributeClass
     * @return mixed
     * @throws \ReflectionException
     */
    final public function getAttribute($attributeClass)
    {
        $reflection = new ReflectionClass($this::class);
        $constants = $reflection->getConstants();
        $key = array_search($this, $constants, false);
        $constantReflection = new ReflectionClassConstant($this::class, $key);
        $attribute = $constantReflection->getAttributes($attributeClass)[0];
        return $attribute->newInstance();
    }

    public static function fromScalar(mixed $scalar)
    {
        $reflection = new \ReflectionClass(static::class);
        $constants = $reflection->getConstants();

        foreach ($constants as $key => $value) {
            if ($value === $scalar) {
                return new static($value, $key);
            }
        }
        throw new Exception(static::class . ' invalid scalar value:' . $scalar);
    }
}
