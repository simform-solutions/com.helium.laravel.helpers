<?php

namespace Tests\Traits;

use Tests\TestModels\HeliumBaseTraitsModel;

/**
 * Inherits all test cases from GeneratesPrimaryKeyTest
 */
class HeliumBaseGeneratesPrimaryKeyTest extends GeneratesPrimaryKeyTest
{
	protected const TEST_CLASS = HeliumBaseTraitsModel::class;
}