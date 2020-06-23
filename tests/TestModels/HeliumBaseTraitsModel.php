<?php

namespace Tests\TestModels;

use Helium\LaravelHelpers\Traits\HeliumBaseTraits;
use Tests\TestModels\Base\SetupGeneratesPrimaryKey;
use Tests\TestModels\Base\SetupHasAttributeEvents;
use Tests\TestModels\Base\SetupHasEnums;
use Tests\TestModels\Base\SetupSelfValidates;
use Tests\TestModels\Base\TestModel;

class HeliumBaseTraitsModel extends TestModel
{
	use HeliumBaseTraits;
	use SetupGeneratesPrimaryKey;
	use SetupHasAttributeEvents;
	use SetupHasEnums;
	use SetupSelfValidates;
}