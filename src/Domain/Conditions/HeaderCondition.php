<?php

namespace Mcustiel\Phiremock\Domain\Conditions;

use Mcustiel\Phiremock\Domain\Condition;
use Mcustiel\Phiremock\Domain\Http\HeaderValue;

class HeaderCondition extends Condition
{
    public function __construct(Matcher $matcher, HeaderValue $url)
    {
        parent::__construct($matcher, $url->asString());
    }

    public function __toString()
    {
        return $this->getMatcher()->asString() . ' ' . $this->getValue()->asString();
    }

    public static function fromCondition(Condition $condition)
    {
        return new self($condition->getMatcher(), new HeaderValue($condition->getValue()));
    }
}
