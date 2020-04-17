<?php

namespace Helium\LaravelHelpers\Classes;

abstract class Enum
{
	public static function all(bool $hasNull = false): array
	{
		return [];
	}
}