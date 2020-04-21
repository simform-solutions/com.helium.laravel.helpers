<?php

namespace Helium\LaravelHelpers\Traits;

use Helium\LaravelHelpers\Helpers\StringHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException as IlluminateValidationException;
use Helium\LaravelHelpers\Exceptions\ValidationException as HeliumValidationException;

trait HasPhoneNumbers
{
	use HasAttributeEvents;

	public function getPhoneNumbers(): array
	{
		return $this->phoneNumbers ?? [
			'phone_number',
			'phone',
			'secondary_phone_number',
			'secondary_phone'
		];
	}

	public static function bootHasPhoneNumbers()
	{
		$model = new static;

		foreach ($model->getPhoneNumbers() as $attribute)
		{
			static::registerAttributeMutator($attribute, function ($value) use ($attribute) {
				return StringHelper::onlyNumeric($value);
			});
		}
	}
}