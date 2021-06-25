<?php

namespace AntanasGa\XmlRpcEncode\Types;

/**
 * ***ArrayV*** defines `array` type for XMLRPC protocol
 */
class ArrayV implements TypeInterface
{
    use ArrayOfTypeTrait;

    private array $valueArray;

    public function __construct(array $valueArray)
    {
        $this->checkClassArray($valueArray, Value::class);
        $this->valueArray = $valueArray;
    }

    /**
     * @return string gets prepared value: `<array><data>%s</data></array>`
     */
    public function __toString()
    {
        $list = '';
        foreach ($this->valueArray as $value) {
            $list .= $value;
        }
        return sprintf('<array><data>%s</data></array>', $list);
    }
}
