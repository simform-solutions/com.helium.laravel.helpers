<?php

namespace Helium\LaravelHelpers\Traits;

use Helium\LaravelHelpers\Classes\Enum;
use Helium\LaravelHelpers\Exceptions\EnumException;
use Illuminate\Database\Eloquent\Model;

trait HasEnums
{
	//region Helpers
	protected function isEnum($key)
	{
		return isset($this->enums) && array_key_exists($key, $this->enums);
	}

	protected function validateInArray($key, $value, $array)
	{
		if (!in_array($value, $array))
		{
			throw new EnumException($key, $value, $array);
		}
	}

	public function validateEnum($key, $value)
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
	public static function bootHasEnums()
	{
		self::settingAttribute(function(Model $model, $key, $value) {
			$model->validateEnum($key, $value);
		});
	}
	//endregion
}