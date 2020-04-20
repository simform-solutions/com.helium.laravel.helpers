<?php

namespace Tests\UnitTests;

use Tests\Models\TestHeliumBaseTraitsModel;
use Tests\Models\TestHeliumBaseTraitsModel2;

/**
 * Inherits all test cases from SelfValidatesTest
 */
class HeliumBaseSelfValidatesTest extends SelfValidatesTest
{
	protected function getInstance()
	{
		try {
			return factory(TestHeliumBaseTraitsModel::class)->create();
		} catch (\Exception $e) {
			println(get_class($e));
			println($e->getTraceAsString());
			die;
		}
	}

	protected function getInstance2()
	{
		try {
			return factory(TestHeliumBaseTraitsModel2::class)->create();
		} catch (\Exception $e) {
			println(get_class($e));
			println($e->getTraceAsString());
			die;
		}
	}
}