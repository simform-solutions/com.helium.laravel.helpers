<?php

namespace Tests\UnitTests;

use Tests\Models\TestHeliumBaseTraitsModel;

/**
 * Inherits all test cases from HasEnumsTest
 */
class HeliumBaseHasEnumsTest extends HasEnumsTest
{
	protected function getInstance()
	{
		return factory(TestHeliumBaseTraitsModel::class)->create([
			'favorite_color' => self::FAVORITE_COLOR_DEFAULT,
			'favorite_primary_color' => self::FAVORITE_PRIMARY_COLOR_DEFAULT
		]);
	}
}