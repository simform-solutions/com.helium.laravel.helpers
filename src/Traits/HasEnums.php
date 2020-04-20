<?php

namespace Helium\LaravelHelpers\Traits;

use Helium\LaravelHelpers\Contracts\Enum;
use Helium\LaravelHelpers\Exceptions\EnumException;
use Illuminate\Database\Eloquent\Model;

trait HasEnums
{
	use HasAttributeEvents;

	//region Helpers
	/**
	 * @description Determines whether the specified attribute is an enum
	 * @param $key
	 * @return bool
	 */
	public function isEnum($key): bool
	{
		return isset($this->enums) && array_key_exists($key, $this->enums);
	}

	/**
	 * @description Validates that the specified attribute value is in the allowed
	 * set of enum values
	 * @param $key
	 * @param $value
	 * @throws EnumException
	 */
	public function validateEnum($key, $value): void
	{
		if ($this->isEnum($key))
		{
			if (is_string($this->enums[$key]) &&
				is_subclass_of($this->enums[$key], Enum::class))
			{
				$enum = $this->enums[$key];
				$array = $enum::all();
			}
			elseif (is_array($this->enums[$key]))
			{
				$array = $this->enums[$key];
			}

			if (!in_array($value, $array))
			{
				throw new EnumException($key, $value, $array);
			}
		}
	}
	//endregion

	//region Functions
	/**
	 * @description Register enum validation on setting attributes
	 */
	public static function bootHasEnums()
	{
		self::settingAttribute(function(Model $model, $key, $value) {
			$model->validateEnum($key, $value);
		});
	}
	//endregion
}