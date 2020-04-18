<?php

namespace Tests\UnitTests;

use Helium\LaravelHelpers\Classes\UuidPrimaryKeyGenerator;
use Helium\LaravelHelpers\Contracts\PrimaryKeyGenerator;
use Tests\Models\TestGeneratesPrimaryKeyModel;
use Tests\TestCase;

abstract class PrimaryKeyGeneratorTest extends TestCase
{
	protected abstract function getInstance(): PrimaryKeyGenerator;

	public function testGenerateUnique()
	{
		$generator = $this->getInstance();

		$this->assertNotEquals($generator->generate(), $generator->generate());
	}
}