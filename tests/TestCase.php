<?php

namespace Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Tests\Models\TestModel;

abstract class TestCase extends BaseTestCase
{
	protected function setUp(): void
	{
		parent::setUp();

		$this->withFactories(__DIR__ . '/database/factories');
		$this->loadMigrationsFrom(__DIR__ . '/database/migrations');
	}

	protected function getEnvironmentSetUp($app)
	{
		// Setup default database to use sqlite :memory:
		$app['config']->set('database.default', 'testbench');
		$app['config']->set('database.connections.testbench', [
			'driver'   => 'sqlite',
			'database' => ':memory:',
			'prefix'   => '',
		]);
	}
}