<?php

namespace Tests\TestModels;

use Helium\LaravelHelpers\Traits\GeneratesPrimaryKey;
use Tests\TestEnums\Color;
use Tests\TestModels\Base\SetupGeneratesPrimaryKey;
use Tests\TestModels\Base\TestModel;

class GeneratesPrimaryKeyModel extends TestModel
{
	use GeneratesPrimaryKey;
	use SetupGeneratesPrimaryKey;
}