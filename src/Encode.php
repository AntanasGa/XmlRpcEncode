<?php

namespace AntanasGa\XmlRpcEncode;

use DateTime;
use AntanasGa\XmlRpcEncode\Types\ArrayV;
use AntanasGa\XmlRpcEncode\Types\Base64V;
use AntanasGa\XmlRpcEncode\Types\BooleanV;
use AntanasGa\XmlRpcEncode\Types\DateTimeV;
use AntanasGa\XmlRpcEncode\Types\DoubleV;
use AntanasGa\XmlRpcEncode\Types\IntV;
use AntanasGa\XmlRpcEncode\Types\StringV;
use AntanasGa\XmlRpcEncode\Types\StructMemberV;
use AntanasGa\XmlRpcEncode\Types\StructV;
use AntanasGa\XmlRpcEncode\Types\Value;
use TypeError;

/**
 * ***Encode*** Encodes XMLRPC request
 *
 * Encoded at `__toString` method
 */
class Encode
{
    private array $parameters;
    private ?string $methodName;

    /**
     * @param array $parameters values to generate `<params>%s</params>` part
     * @param string|null $methodName value to generate `<methodName>%s</methodName>` part
     */
    public function __construct(array $parameters, ?string $methodName = null)
    {
        $this->parameters = $parameters;
        $this->methodName = $methodName;
    }

    /**
     * Generates encoded XMLRPC spec string
     * @return string `<methodCall><methodName>%s(methodName)</methodName>%s(parameters)</methodCall>`
     * if methodName is null: <methodResponse>%s(parameters)</method>
     */
    public function __toString()
    {
        $response = '';
        $xmlprefix = '<?xml version=\'1.0\'?>';
        $params = new Params($this->handleParametersArray($this->parameters));
        if ($this->methodName !== null) {
            $response = sprintf(
                '%s<methodCall><methodName>%s</methodName>%s</methodCall>',
                $xmlprefix,
                $this->methodName,
                $params
            );
        } else {
            $response = sprintf(
                '%s<methodResponse>%s</methodResponse>',
                $xmlprefix,
                $params
            );
        }
        return $response;
    }

    /**
     * ***base64*** passes base64 values.
     * ***Value will be encoded***
     *
     * @param  string $parameter
     * @return Value
     */
    public static function base64(string $parameter): Value
    {
        return new Value(new Base64V($parameter));
    }

    /**
     * ***handleParametersArray*** handles array of values
     *
     * @param  array $values parameter array
     * @return array AntanasGa\XmlRpcEncode\Types\Value array
     */
    private function handleParametersArray(array $values): array
    {
        $paramList = [];
        foreach ($values as $parameter) {
            $paramList[] = $this->handleSingle($parameter);
        }
        return $paramList;
    }

    /**
     * ***handleSingle*** handles single value
     *
     * @param  mixed $parameter parameter that will be converted to value
     * @return Value
     */
    private function handleSingle($parameter): Value
    {
        $paramHandled = null;
        switch (gettype($parameter)) {
            case 'array':
                $paramHandled = $this->handleArray($parameter);
                break;
            case 'integer':
                $paramHandled = $this->handleInt($parameter);
                break;
            case 'boolean':
                $paramHandled = $this->handleBoolean($parameter);
                break;
            case 'string':
                $paramHandled = $this->handleString($parameter);
                break;
            case 'double':
                $paramHandled = $this->handleDouble($parameter);
                break;
            case 'object':
                $paramHandled = $this->handleObject($parameter);
                break;
            default:
                throw new TypeError(
                    sprintf('Unexpected variable type (%s)', gettype($parameter))
                );
                break;
        }
        return $paramHandled;
    }

    /**
     * ***handleArray*** Converts `array` to XMLRPC compatable. if array has keys converts to `struct`
     *
     * @param  array $parameter
     * @return Value
     */
    private function handleArray(array $parameter): Value
    {
        $values = [];
        $array = null;
        if (array_keys($parameter) !== range(0, count($parameter) - 1)) {
            foreach ($parameter as $key => $value) {
                $values[] = new StructMemberV($key, $this->handleSingle($value));
            }
            $array = new StructV($values);
        } else {
            foreach ($parameter as $value) {
                $values[] = $this->handleSingle($value);
            }
            $array = new ArrayV($values);
        }
        return new Value($array);
    }

    /**
     * ***handleInt*** Converts `int` to XMLRPC compatable
     *
     * @param  int $parameter
     * @return Value
     */
    private function handleInt(int $parameter): Value
    {
        return new Value(new IntV($parameter));
    }

    /**
     * ***handleBoolean*** Converts `boolean` to XMLRPC compatable
     *
     * @param  bool $parameter
     * @return Value
     */
    private function handleBoolean(bool $parameter): Value
    {
        return new Value(new BooleanV($parameter));
    }

    /**
     * ***handleString*** Converts `string` to XMLRPC compatable
     *
     * @param  string $parameter
     * @return Value
     */
    private function handleString(string $parameter): Value
    {
        return new Value(new StringV($parameter));
    }

    /**
     * ***handleDouble*** Converts `float` to XMLRPC compatable
     *
     * @param  mixed $parameter
     * @return Value
     */
    private function handleDouble(float $parameter): Value
    {
        return new Value(new DoubleV($parameter));
    }

    /**
     * ***handleObject*** Converts `object` to XMLRPC compatable
     *
     * @param  mixed $parameter
     * @return Value
     */
    private function handleObject(object $parameter): Value
    {
        $response = null;
        if ($parameter instanceof \DateTime) {
            $response = new Value(new DateTimeV($parameter));
        } elseif ($parameter instanceof Value) {
            $response = $parameter;
        } else {
            throw new TypeError(
                sprintf('Expected DateTime object, got %s', gettype($parameter))
            );
        }
        return $response;
    }
}
