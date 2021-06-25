<?php

namespace AntanasGa\XmlRpcEncode\Types;

/**
 * ***IntV*** defines `int` type for XMLRPC protocol
 */
class IntV implements TypeInterface
{
    private int $param;

    public function __construct(int $parameter)
    {
        $this->param = $parameter;
    }

    /**
     * @return string gets prepared value: `<int>%d</int>`
     */
    public function __toString()
    {
        return sprintf('<int>%d</int>', $this->param);
    }
}
