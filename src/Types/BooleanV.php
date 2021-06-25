<?php

namespace AntanasGa\XmlRpcEncode\Types;

/**
 * ***BooleanV*** defines `boolean` type for XMLRPC protocol
 */
class BooleanV implements TypeInterface
{
    private int $param;

    public function __construct(bool $parameter)
    {
        $prm = 0;
        if ($parameter) {
            $prm = 1;
        }
        $this->param = $prm;
    }

    /**
     * @return string gets prepared value: `<boolean>%d</boolean>` true = 1 | false = 0
     */
    public function __toString()
    {
        return sprintf('<boolean>%d</boolean>', $this->param);
    }
}
