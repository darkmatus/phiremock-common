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

namespace Mcustiel\Phiremock\Common\Utils;

use Mcustiel\Phiremock\Domain\Expectation;

class ExpectationToArrayConverter
{
    /** @var RequestConditionToArrayConverter */
    private $requestToArrayConverter;

    /** @var ResponseToArrayConverterLocator */
    private $responseConverterLocator;

    public function __construct(
        RequestConditionToArrayConverter $requestConverter,
        ResponseToArrayConverterLocator $responseConverterLocator
    ) {
        $this->requestToArrayConverter = $requestConverter;
        $this->responseConverterLocator = $responseConverterLocator;
    }

    public function convert(Expectation $expectation)
    {
        $expectationArray = [];

        if ($expectation->hasScenarioName()) {
            $expectationArray['scenarioName'] = $expectation->getScenarioName()->asString();
        } else {
            $expectationArray['scenarioName'] = null;
        }
        if ($expectation->getRequest()->hasScenarioState()) {
            $expectationArray['scenarioStateIs'] = $expectation->getRequest()->getScenarioState()->asString();
        } else {
            $expectationArray['scenarioStateIs'] = null;
        }
        if ($expectation->getResponse()->hasNewScenarioState()) {
            $expectationArray['newScenarioState'] = $expectation->getResponse()->getNewScenarioState()->asString();
        } else {
            $expectationArray['newScenarioState'] = null;
        }

        $expectationArray['request'] = $this->requestToArrayConverter->convert($expectation->getRequest());

        $response = $expectation->getResponse();

        if ($response->isHttpResponse()) {
            $expectationArray['response'] = $this->responseConverterLocator
                ->locate($expectation->getResponse())
                ->convert($expectation->getResponse());
            $expectationArray['proxyTo'] = null;
        } else {
            $expectationArray['response'] = null;
            $expectationArray['proxyTo'] = $expectation->getResponse()->getUri()->asString();
        }

        if ($expectation->hasPriority()) {
            $expectationArray['priority'] = $expectation->getPriority()->asInt();
        } else {
            $expectationArray['priority'] = 0;
        }

        return $expectationArray;
    }
}
