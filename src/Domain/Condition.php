<?php
/**
 * This file is part of Phiremock.
 *
 * Phiremock is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Phiremock is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Phiremock.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Mcustiel\Phiremock\Domain;

use Mcustiel\Phiremock\Domain\Conditions\Matcher;

class Condition implements \JsonSerializable
{
    /**
     * @var Matcher
     */
    private $matcher;
    /**
     * @var mixed
     */
    private $value;

    /**
     * @param string|null $matcher
     * @param mixed       $value
     */
    public function __construct(Matcher $matcher, $value)
    {
        $this->matcher = $matcher;
        $this->value = $value;
    }

    public function __toString()
    {
        return $this->matcher->asString() . ' ' . var_export($this->value, true);
    }

    /**
     * @return Matcher
     */
    public function getMatcher()
    {
        return $this->matcher;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     *
     * @see \JsonSerializable::jsonSerialize()
     */
    public function jsonSerialize()
    {
        return [$this->matcher->asString() => $this->value];
    }
}
