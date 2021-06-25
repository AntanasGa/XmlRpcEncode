<?php

namespace AntanasGa\XmlRpcEncode\Types;

/**
 * ***Value*** General value class accepts variables of type `AntanasGa\XmlRpcEncode\Types\TypeInterface`
 */
class Value
{
    private TypeInterface $param;

    public function __construct(TypeInterface $parameter)
    {
        $this->param = $parameter;
    }
    
    /**
     * @return string `<value><int|string|...></"-"></value>`
     */
    public function __toString()
    {
        return sprintf('<value>%s</value>', $this->param);
    }
}
