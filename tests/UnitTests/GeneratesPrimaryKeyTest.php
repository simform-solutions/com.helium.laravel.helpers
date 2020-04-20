<?php

namespace Tests\UnitTests;

use Tests\Models\TestGeneratesPrimaryKeyModel;
use Tests\TestCase;

class GeneratesPrimaryKeyTest extends TestCase
{
	protected function getInstance()
	{
		return factory(TestGeneratesPrimaryKeyModel::class)->create([
			'id' => null
		]);
	}

	public function testCreate()
	{
		$model = $this->getInstance();

		$this->assertIsString($model->getKey());
		$this->assertRegExp("/^{$model->primaryKeyPrefix}-[a-f0-9]{32}$/", $model->getKey());
	}

	public function testUpdate()
	{
		/**
		 * Test that update does not re-generate/change the primary key
		 */
		$model = $this->getInstance();

		$key = $model->getKey();

		$model->update([
			'string' => 'lorem ipsum'
		]);

		$this->assertEquals($key, $model->getKey());
	}
}