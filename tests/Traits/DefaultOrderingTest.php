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
		$this->assertStringContainsString('"updated_at" desc', $sql);
	}

	public function testSpecifiedOrdering()
	{
		$sql = TestDefaultOrderingModel2::query()->toSql();

		$this->assertStringContainsString('order by', $sql);
		$this->assertStringContainsString('"created_at" desc', $sql);
		$this->assertStringContainsString('"updated_at" asc', $sql);
	}
}