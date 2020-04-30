<?php

namespace Tests\Traits;

use Tests\TestModels\TestHeliumBaseTraitsModel;
use Tests\TestModels\TestHeliumBaseTraitsModel2;

/**
 * Inherits all test cases from SelfValidatesTest
 */
class HeliumBaseSelfValidatesTest extends SelfValidatesTest
{
	protected const TEST_CLASS = TestHeliumBaseTraitsModel::class;
	protected const TEST_CLASS_2 = TestHeliumBaseTraitsModel2::class;
}