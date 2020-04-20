<?php

namespace Tests\UnitTests;

use Tests\Models\TestHeliumBaseTraitsModel;

/**
 * Inherits all test cases from GeneratesPrimaryKeyTest
 */
class HeliumBaseGeneratesPrimaryKeyTest extends GeneratesPrimaryKeyTest
{
	protected function getInstance()
	{
		return factory(TestHeliumBaseTraitsModel::class)->create([
			'id' => null
		]);
	}
}