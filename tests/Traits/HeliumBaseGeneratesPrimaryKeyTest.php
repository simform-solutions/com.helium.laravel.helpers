<?php

namespace Tests\Traits;

use Tests\TestModels\TestHeliumBaseTraitsModel;

/**
 * Inherits all test cases from GeneratesPrimaryKeyTest
 */
class HeliumBaseGeneratesPrimaryKeyTest extends GeneratesPrimaryKeyTest
{
	protected const TEST_CLASS = TestHeliumBaseTraitsModel::class;
}