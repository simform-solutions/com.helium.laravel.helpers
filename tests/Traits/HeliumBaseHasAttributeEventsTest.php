<?php

namespace Tests\Traits;

use Tests\TestModels\HeliumBaseTraitsModel;

/**
 * Inherits all test cases from HasAttributeEventsTest
 */
class HeliumBaseHasAttributeEventsTest extends HasAttributeEventsTest
{
	protected const TEST_CLASS = HeliumBaseTraitsModel::class;
}