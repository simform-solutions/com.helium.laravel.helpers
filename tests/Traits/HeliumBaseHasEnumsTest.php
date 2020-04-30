<?php

namespace Tests\Traits;

use Tests\TestModels\TestHeliumBaseTraitsModel;

/**
 * Inherits all test cases from HasEnumsTest
 */
class HeliumBaseHasEnumsTest extends HasEnumsTest
{
	protected const TEST_CLASS = TestHeliumBaseTraitsModel::class;
}