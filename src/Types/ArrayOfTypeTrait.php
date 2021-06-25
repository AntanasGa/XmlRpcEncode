<?php

namespace AntanasGa\XmlRpcEncode\Types;

use TypeError;

/**
 * ***ArrayOfTypeTrait*** provides array value check
 */
trait ArrayOfTypeTrait
{
        
    /**
     * ***checkClassArray*** Checks that every value is of specific class type.
     * Throws exception if it doesn't.
     *
     * @param  array $array 
     * @param  string $class
     * @return void
     */
    public function checkClassArray(array $array, string $class): void
    {
        foreach ($array as $value) {
            if (!($value instanceof $class)) {
                throw new TypeError(
                    sprintf(
                        'Expected array value to be of type AntanasGa\XmlRpcEncode\Value, got %s',
                        gettype($value)
                    )
                );
            }
        }
    }
}
