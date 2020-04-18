<?php

namespace Tests\UnitTests;

use Tests\Models\TestHasAdminsModel;
use Tests\TestCase;

class HasAdminsTest extends TestCase
{
	protected function getInstance($args = [])
	{
		return factory(TestHasAdminsModel::class)->create($args);
	}

	public function testIsAdmin()
	{
		$model = $this->getInstance(['admin' => true]);

		$this->assertTrue($model->isAdmin());

		$model = $this->getInstance(['admin' => false]);

		$this->assertFalse($model->isAdmin());
	}
}