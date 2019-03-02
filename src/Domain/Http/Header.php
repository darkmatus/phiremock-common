<?php

namespace Mcustiel\Phiremock\Domain\Http;

class Header implements \JsonSerializable
{
    /** @var HeaderName * */
    private $name;

    /** @var HeaderValue * */
    private $value;

    public function __construct(HeaderName $name, HeaderValue $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * @return HeaderName
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return HeaderValue
     */
    public function getValue()
    {
        return $this->value;
    }

    public function jsonSerialize()
    {
        return [$this->name => $this->value];
    }
}
