<?php

namespace Tests\TestModels;

use Helium\LaravelHelpers\Traits\HasFullName;
use Tests\TestModels\Base\TestModel;

class TestHasFullNameModel extends TestModel
{
	use HasFullName;

	public $firstNameAttribute = null;
	public $lastNameAttribute = null;
}