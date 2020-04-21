<?php

namespace Tests\UnitTests;

use Tests\Models\TestHeliumBaseTraitsModel;

/**
 * Inherits all test cases from HasAttributeEventsTest
 */
class HeliumBaseHasAttributeEventsTest extends HasAttributeEventsTest
{
	protected const TEST_CLASS = TestHeliumBaseTraitsModel::class;
}