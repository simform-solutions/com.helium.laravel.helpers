<?php

namespace Tests\TestModels;

use Helium\LaravelHelpers\Traits\HasAttributeEvents;
use Helium\LaravelHelpers\Traits\HasEnums;
use Tests\TestModels\Base\SetupHasEnums;
use Tests\TestModels\Base\TestModel;

class HasEnumsModel extends TestModel
{
    use HasAttributeEvents;
	use HasEnums;
	use SetupHasEnums;
}