<?php

namespace Tests\TestModels;

use Helium\LaravelHelpers\Traits\HeliumBaseTraits;
use Tests\TestModels\Base\SetupGeneratesPrimaryKey;
use Tests\TestModels\Base\SetupHasAttributeEvents;
use Tests\TestModels\Base\SetupHasEnums;
use Tests\TestModels\Base\SetupSelfValidates2;
use Tests\TestModels\Base\TestModel;

class TestHeliumBaseTraitsModel2 extends TestModel
{
	use HeliumBaseTraits;
	use SetupGeneratesPrimaryKey;
	use SetupHasAttributeEvents;
	use SetupHasEnums;
	use SetupSelfValidates2;

	protected $table = 'test_helium_base_traits_models';
}