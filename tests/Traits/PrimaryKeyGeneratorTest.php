<?php

namespace Tests\Traits;

use Helium\LaravelHelpers\Generators\UuidPrimaryKeyGenerator;
use Helium\LaravelHelpers\Contracts\PrimaryKeyGenerator;
use Tests\TestModels\GeneratesPrimaryKeyModel;
use Tests\TestCase;

abstract class PrimaryKeyGeneratorTest extends TestCase
{
	protected abstract function getInstance(): PrimaryKeyGenerator;

	public function testGenerateUnique()
	{
		$generator = $this->getInstance();

		$keys = [];

		//Generate 10,000 keys, ensure they are all unique
		for ($i = 0; $i < 10000; $i++)
		{
			$newKey = $generator->generate();

			$this->assertNotContains($newKey, $keys);

			$keys[] = $newKey;
		}
	}
}