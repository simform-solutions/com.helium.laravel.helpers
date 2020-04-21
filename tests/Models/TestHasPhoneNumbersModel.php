<?php

namespace Tests\Models;

use Helium\LaravelHelpers\Traits\HasPhoneNumbers;
use Tests\Models\Base\TestModel;

class TestHasPhoneNumbersModel extends TestModel
{
	use HasPhoneNumbers;

	public $phoneNumbers = null;
}