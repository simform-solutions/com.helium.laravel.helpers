<?php

namespace Tests\TestModels;

use Helium\LaravelHelpers\Traits\BatchActions;
use Helium\LaravelHelpers\Traits\DefaultOrdering;
use Tests\TestModels\Base\TestModel;

class TestBatchActionsModel extends TestModel
{
	use BatchActions;
}