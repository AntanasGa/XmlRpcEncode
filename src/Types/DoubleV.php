<?php

namespace AntanasGa\XmlRpcEncode\Types;

/**
 * ***DoubleV*** defines `float` type for XMLRPC protocol
 */
class DoubleV implements TypeInterface
{
    private float $param;

    public function __construct(float $parameter)
    {
        $this->param = $parameter;
    }

    /**
     * @return string gets prepared value: `<double>%f</double>`
     */
    public function __toString()
    {
        return sprintf('<double>%f</double>', $this->param);
    }
}
