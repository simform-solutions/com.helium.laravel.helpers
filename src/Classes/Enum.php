<?php

namespace Helium\LaravelHelpers\Classes;

use ReflectionClass;

abstract class Enum
{
	public static function all(bool $acceptNull = false): array
	{
		$reflector = new ReflectionClass(static::class);

		$all = array_values($reflector->getConstants());

		if ($acceptNull)
		{
			$all[] = null;
		}

		return $all;
	}
}