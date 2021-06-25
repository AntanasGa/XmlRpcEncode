<?php

namespace AntanasGa\XmlRpcEncode\Types;

/**
 * ***StructV*** defines `array` with keys type for XMLRPC protocol
 */
class StructV implements TypeInterface
{
    use ArrayOfTypeTrait;

    private array $structMembers;

    public function __construct(array $structMembers)
    {
        $this->checkClassArray($structMembers, StructMemberV::class);
        $this->structMembers = $structMembers;
    }

    /**
     * @return string `<struct>[<member>%s(AntanasGa\XmlRpcEncode\Types\StructMemberV)</member>]...</struct>`
     */
    public function __toString()
    {
        $struct = '';
        foreach ($this->structMembers as $member) {
            $struct .= $member;
        }
        return sprintf('<struct>%s</struct>', $struct);
    }
}
