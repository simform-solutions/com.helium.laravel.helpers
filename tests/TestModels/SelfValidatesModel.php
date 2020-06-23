<?php

namespace Tests\TestModels;

use Helium\LaravelHelpers\Traits\SelfValidates;
use Tests\TestModels\Base\SetupSelfValidates;
use Tests\TestModels\Base\TestModel;

class SelfValidatesModel extends TestModel
{
	use SelfValidates;
	use SetupSelfValidates;
}