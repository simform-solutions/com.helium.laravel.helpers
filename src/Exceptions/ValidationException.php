<?php

namespace Helium\LaravelHelpers\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException as IlluminateValidationException;

class ValidationException extends Exception
{
	protected $errors = [];

	public function __construct(IlluminateValidationException $previous)
	{
		$this->errors = $previous->validator->errors()->all();

		$message = implode(PHP_EOL, $this->errors);

		parent::__construct($message, 0, $previous);
	}

	public function toArray()
	{
		return $this->errors;
	}

	public function toCollection()
	{
		return collect($this->errors);
	}
}