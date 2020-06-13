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

namespace Mcustiel\Phiremock\Domain\Http;

class HeaderName
{
    /** @var string * */
    private $headerName;

    /**
     * @param string $headerName
     */
    public function __construct($headerName)
    {
        $this->ensureIsValidHeaderName($headerName);
        $this->headerName = $headerName;
    }

    /**
     * @return string
     */
    public function asString()
    {
        return $this->headerName;
    }

    /**
     * @param HeaderName $other
     *
     * @return bool
     */
    public function equals($other)
    {
        return $other->asString() === $this->asString();
    }

    private function ensureIsValidHeaderName($headerName)
    {
        if (!\is_string($headerName)) {
            throw new \InvalidArgumentException(sprintf('Header name must be a string. Got: %s', \gettype($headerName)));
        }
    }
}
