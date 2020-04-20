<?php

namespace Tests\Models;

use Helium\LaravelHelpers\Traits\SelfValidates;
use Tests\Models\Base\SetupSelfValidates;
use Tests\Models\Base\TestModel;

class TestSelfValidatesModel extends TestModel
{
	use SelfValidates;
	use SetupSelfValidates;
}