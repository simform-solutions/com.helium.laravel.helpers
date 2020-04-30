<?php

namespace Tests\TestModels;

use Helium\LaravelHelpers\Traits\HasAttributeEvents;
use Tests\TestModels\Base\SetupHasAttributeEvents;
use Tests\TestModels\Base\TestModel;

class TestHasAttributeEventsModel extends TestModel
{
	use HasAttributeEvents;
	use SetupHasAttributeEvents;
}