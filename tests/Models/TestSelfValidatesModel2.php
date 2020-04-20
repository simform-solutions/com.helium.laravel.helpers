<?php

namespace Tests\Models;

use Helium\LaravelHelpers\Traits\SelfValidates;
use Tests\Models\Base\SetupSelfValidates2;
use Tests\Models\Base\TestModel;

class TestSelfValidatesModel2 extends TestModel
{
	use SelfValidates;
	use SetupSelfValidates2;

	protected $table = 'test_self_validates_models';
}