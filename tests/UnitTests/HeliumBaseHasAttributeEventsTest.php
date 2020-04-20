<?php

namespace Tests\UnitTests;

use Tests\Models\TestHeliumBaseTraitsModel;

/**
 * Inherits all test cases from HasAttributeEventsTest
 */
class HeliumBaseHasAttributeEventsTest extends HasAttributeEventsTest
{
	protected function getInstance()
	{
		return factory(TestHeliumBaseTraitsModel::class)->create();
	}
}