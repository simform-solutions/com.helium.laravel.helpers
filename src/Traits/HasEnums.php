<?php

namespace Helium\LaravelHelpers\Traits;

use Helium\LaravelHelpers\Contracts\Enum;
use Helium\LaravelHelpers\Exceptions\EnumException;
use Illuminate\Database\Eloquent\Model;

trait HasEnums
{
	//region Helpers
	/**
	 * @description Determines whether the specified attribute is an enum
	 * @param $key
	 * @return bool
	 */
	protected function isEnum($key): bool
	{
		return isset($this->enums) && array_key_exists($key, $this->enums);
	}

	/**
	 * @description Validates that the specified attribute value is in the allowed set of values
	 * @param $key
	 * @param $value
	 * @param $array
	 * @throws EnumException
	 */
	protected function validateInArray($key, $value, $array): void
	{
		if (!in_array($value, $array))
		{
			throw new EnumException($key, $value, $array);
		}
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
				$this->validateInArray($key, $value, $enum::all());
			}
			elseif (is_array($this->enums[$key]))
			{
				$this->validateInArray($key, $value, $this->enums[$key]);
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