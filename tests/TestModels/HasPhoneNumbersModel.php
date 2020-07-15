<?php

namespace Tests\TestModels;

use Helium\LaravelHelpers\Traits\HasAttributeEvents;
use Helium\LaravelHelpers\Traits\HasPhoneNumbers;
use Tests\TestModels\Base\TestModel;

class HasPhoneNumbersModel extends TestModel
{
    use HasAttributeEvents;
	use HasPhoneNumbers;

	public $phoneNumbers = null;
}