<?php

namespace Tests\Models;

use Helium\LaravelHelpers\Traits\HasEnums;
use Tests\Models\Base\SetupHasEnums;
use Tests\Models\Base\TestModel;

class TestHasEnumsModel extends TestModel
{
	use HasEnums;
	use SetupHasEnums;
}