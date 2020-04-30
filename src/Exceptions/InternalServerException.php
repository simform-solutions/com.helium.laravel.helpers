<?php

namespace Helium\LaravelHelpers\Exceptions;

use Throwable;

class InternalServerException extends UserException
{
	public function __construct(Throwable $previous = null)
	{
		$message = trans('error.general');
		parent::__construct($message, 0, $previous);
	}
}