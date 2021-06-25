<?php

namespace AntanasGa\XmlRpcEncode\Types;

/**
 * ***TypeInterface*** Common type used for `AntanasGa\XmlRpcEncode\Types\Value`
 */
interface TypeInterface
{
    /**
     * Method __toString Prepares value to XMLRPC
     *
     */
    public function __toString();
}
