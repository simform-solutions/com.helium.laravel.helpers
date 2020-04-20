<?php

namespace Tests\Models;

use Helium\LaravelHelpers\Traits\GeneratesPrimaryKey;
use Tests\Enums\Color;
use Tests\Models\Base\SetupGeneratesPrimaryKey;
use Tests\Models\Base\TestModel;

class TestGeneratesPrimaryKeyModel extends TestModel
{
	use GeneratesPrimaryKey;
	use SetupGeneratesPrimaryKey;
}