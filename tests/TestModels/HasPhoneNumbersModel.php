<?php

namespace Tests\TestModels;

use Helium\LaravelHelpers\Traits\HasPhoneNumbers;
use Tests\TestModels\Base\TestModel;

class HasPhoneNumbersModel extends TestModel
{
	use HasPhoneNumbers;

	public $phoneNumbers = null;
}