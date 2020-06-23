<?php

namespace Tests\Traits;

use Helium\LaravelHelpers\Classes\UuidPrimaryKeyGenerator;
use Helium\LaravelHelpers\Contracts\PrimaryKeyGenerator;
use Tests\TestModels\GeneratesPrimaryKeyModel;
use Tests\TestCase;

class UuidPrimaryKeyGeneratorTest extends PrimaryKeyGeneratorTest
{
	protected function getInstance(): PrimaryKeyGenerator
	{
		$model = new GeneratesPrimaryKeyModel();
		return new UuidPrimaryKeyGenerator($model);
	}

	public function testGenerateFormat()
	{
		$model = new GeneratesPrimaryKeyModel();
		$generator = new UuidPrimaryKeyGenerator($model);

		$this->assertRegExp("/^{$model->primaryKeyPrefix}-[a-f0-9]{32}$/", $generator->generate());
	}
}