<?php

namespace AntanasGa\XmlRpcEncode\Types;

use DateTime;

/**
 * ***DateTimeV*** defines `DateTime` type for XMLRPC protocol
 */
class DateTimeV implements TypeInterface
{
    private DateTime $param;

    public function __construct(\DateTime $parameter)
    {
        $this->param = $parameter;
    }

    /**
     * @return string gets prepared value: `<dateTime.iso8601>%s</dateTime.iso8601>`
     */
    public function __toString()
    {
        return sprintf('<dateTime.iso8601>%s</dateTime.iso8601>', $this->param->format(\DateTime::ISO8601));
    }
}
