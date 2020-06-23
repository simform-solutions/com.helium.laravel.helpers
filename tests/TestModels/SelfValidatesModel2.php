<?php

namespace Tests\TestModels;

use Helium\LaravelHelpers\Traits\SelfValidates;
use Tests\TestModels\Base\SetupSelfValidates2;
use Tests\TestModels\Base\TestModel;

class SelfValidatesModel2 extends TestModel
{
	use SelfValidates;
	use SetupSelfValidates2;

	protected $table = 'self_validates_models';
}