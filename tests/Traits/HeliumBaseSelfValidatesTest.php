<?php

namespace Tests\Traits;

use Tests\TestModels\HeliumBaseTraitsModel;
use Tests\TestModels\HeliumBaseTraitsModel2;

/**
 * Inherits all test cases from SelfValidatesTest
 */
class HeliumBaseSelfValidatesTest extends SelfValidatesTest
{
	protected const TEST_CLASS = HeliumBaseTraitsModel::class;
	protected const TEST_CLASS_2 = HeliumBaseTraitsModel2::class;
}