<?php

namespace Tests\TestModels;

use Helium\LaravelHelpers\Traits\HasFullName;
use Tests\TestModels\Base\TestModel;

class HasFullNameModel extends TestModel
{
	use HasFullName;

	public $firstNameAttribute = null;
	public $lastNameAttribute = null;
}