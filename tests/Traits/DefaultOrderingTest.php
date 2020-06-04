<?php

namespace Tests\Traits;

use Tests\TestCase;
use Tests\TestModels\TestDefaultOrderingModel;
use Tests\TestModels\TestDefaultOrderingModel2;

class DefaultOrderingTest extends TestCase
{
	public function testDefaultOrdering()
	{
		$sql = TestDefaultOrderingModel::query()->toSql();

		$this->assertStringContainsString('order by', $sql);
		$this->assertStringContainsString('"test_default_ordering_models"."updated_at" desc', $sql);
	}

	public function testSpecifiedOrdering()
	{
		$sql = TestDefaultOrderingModel2::query()->toSql();

		$this->assertStringContainsString('order by', $sql);
		$this->assertStringContainsString('"test_default_ordering_models"."created_at" desc', $sql);
		$this->assertStringContainsString('"test_default_ordering_models"."updated_at" asc', $sql);
	}
}