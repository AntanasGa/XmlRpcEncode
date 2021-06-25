<?php

namespace AntanasGa\XmlRpcEncode;

use AntanasGa\XmlRpcEncode\Types\ArrayOfTypeTrait;
use AntanasGa\XmlRpcEncode\Types\Value;
use TypeError;

/**
 * ***Params*** requires AntanasGa\XmlRpcEncode\Types\Value array
 *
 * Returns `<params>%s</params>` at `__toString` method
 */
class Params
{
    use ArrayOfTypeTrait;

    private array $valueArray;

    public function __construct(array $valueArray)
    {
        $this->checkClassArray($valueArray, Value::class);
        $this->valueArray = $valueArray;
    }

    /**
     * __toString
     *
     * @return string `<params>[<param>%s</param>]...</params>`
     */
    public function __toString()
    {
        $paramList = '';
        foreach ($this->valueArray as $value) {
            $paramList .= sprintf('<param>%s</param>', $value);
        }
        return sprintf('<params>%s</params>', $paramList);
    }
}
