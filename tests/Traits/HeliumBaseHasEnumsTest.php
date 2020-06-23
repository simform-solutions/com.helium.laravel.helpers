<?php

namespace Tests\Traits;

use Tests\TestModels\HeliumBaseTraitsModel;

/**
 * Inherits all test cases from HasEnumsTest
 */
class HeliumBaseHasEnumsTest extends HasEnumsTest
{
	protected const TEST_CLASS = HeliumBaseTraitsModel::class;
}