<?php

namespace Tests\Traits;

use Tests\TestModels\TestHeliumBaseTraitsModel;

/**
 * Inherits all test cases from HasAttributeEventsTest
 */
class HeliumBaseHasAttributeEventsTest extends HasAttributeEventsTest
{
	protected const TEST_CLASS = TestHeliumBaseTraitsModel::class;
}