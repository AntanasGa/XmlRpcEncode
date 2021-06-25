<?php

namespace AntanasGa\XmlRpcEncode\Types;

/**
 * ***StructMemberV*** defines `array` value with key type for XMLRPC protocol
 */
class StructMemberV implements TypeInterface
{
    private string $key;
    private Value $value;

    public function __construct(string $key, Value $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * @return string `<member><name>%s</name>%s(AntanasGa\XmlRpcEncode\Types\Value)</member>`
     */
    public function __toString()
    {
        return sprintf('<member><name>%s</name>%s</member>', $this->key, $this->value);
    }
}
