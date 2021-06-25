<?php

namespace AntanasGa\XmlRpcEncode\Types;

/**
 * StringV defines `string` type for XMLRPC protocol
 */
class StringV implements TypeInterface
{
    private string $param;

    public function __construct(string $parameter)
    {
        $this->param = $parameter;
    }

    /**
     * @return string gets prepared value: `<string>%s</string>`
     */
    public function __toString(): string
    {
        return sprintf('<string>%s</string>', $this->param);
    }
}
