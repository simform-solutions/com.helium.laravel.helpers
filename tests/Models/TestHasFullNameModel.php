<?php

namespace Tests\Models;

use Helium\LaravelHelpers\Traits\HasFullName;
use Tests\Models\Base\TestModel;

class TestHasFullNameModel extends TestModel
{
	use HasFullName;

	public $firstNameAttribute = null;
	public $lastNameAttribute = null;
}