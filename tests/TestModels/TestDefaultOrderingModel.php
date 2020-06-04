<?php

namespace Tests\TestModels;

use Helium\LaravelHelpers\Traits\DefaultOrdering;
use Tests\TestModels\Base\TestModel;

class TestDefaultOrderingModel extends TestModel
{
	use DefaultOrdering;
}