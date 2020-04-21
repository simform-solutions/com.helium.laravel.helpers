<?php

namespace Tests\UnitTests;

use Tests\Models\TestHeliumBaseTraitsModel;
use Tests\Models\TestHeliumBaseTraitsModel2;

/**
 * Inherits all test cases from SelfValidatesTest
 */
class HeliumBaseSelfValidatesTest extends SelfValidatesTest
{
	protected const TEST_CLASS = TestHeliumBaseTraitsModel::class;
	protected const TEST_CLASS_2 = TestHeliumBaseTraitsModel2::class;
}