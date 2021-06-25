<?php

namespace AntanasGa\XmlRpcEncode\Types;

/**
 * ***Base64V*** defines `base64` type for XMLRPC protocol.
 * ***String will be encoded, no need to encode***
 */
class Base64V implements TypeInterface
{
    private string $parameter;

    /**
     * @param  string $parameter not encoded string
     */
    public function __construct(string $parameter)
    {
        $this->parameter = $parameter;
    }

    /**
     * @return string gets prepared value: `<base64>%s</base64>`
     */
    public function __toString()
    {
        $param = base64_encode($this->parameter);
        return sprintf('<base64>%s</base64>', $param);
    }
}
