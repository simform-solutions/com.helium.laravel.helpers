<?php

namespace Tests\TestModels;

use Helium\LaravelHelpers\Traits\DefaultOrdering;
use Tests\TestModels\Base\TestModel;

class DefaultOrderingModel extends TestModel
{
	use DefaultOrdering;
}