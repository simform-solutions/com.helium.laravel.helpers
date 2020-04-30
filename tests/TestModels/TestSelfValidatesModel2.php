<?php

namespace Tests\TestModels;

use Helium\LaravelHelpers\Traits\SelfValidates;
use Tests\TestModels\Base\SetupSelfValidates2;
use Tests\TestModels\Base\TestModel;

class TestSelfValidatesModel2 extends TestModel
{
	use SelfValidates;
	use SetupSelfValidates2;

	protected $table = 'test_self_validates_models';
}