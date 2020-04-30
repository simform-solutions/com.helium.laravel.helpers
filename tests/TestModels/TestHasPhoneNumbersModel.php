<?php

namespace Tests\TestModels;

use Helium\LaravelHelpers\Traits\HasPhoneNumbers;
use Tests\TestModels\Base\TestModel;

class TestHasPhoneNumbersModel extends TestModel
{
	use HasPhoneNumbers;

	public $phoneNumbers = null;
}