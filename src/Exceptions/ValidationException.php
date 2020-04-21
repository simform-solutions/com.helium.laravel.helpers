<?php

namespace Helium\LaravelHelpers\Exceptions;

use Exception;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException as IlluminateValidationException;

class ValidationException extends Exception
{
	protected $errors = [];

	public function __construct(IlluminateValidationException $previous, array $attributes)
	{
		$this->errors = [];

		foreach ($previous->validator->errors()->toArray() as $key => $errors) {
			foreach ($errors as $error) {
				$value = array_key_exists($key, $attributes) ? $attributes[$key] : 'null';

				$this->errors[] = "{$error}, value: {$value}";
			}
		}

		$message = implode(PHP_EOL, $this->errors);

		parent::__construct($message, 0, $previous);
	}

	/**
	 * @description Get all validation errors as an Array
	 * @return array
	 */
	public function toArray(): array
	{
		return $this->errors;
	}

	/**
	 * @description Get all validation errors as a Collection
	 * @return Collection
	 */
	public function toCollection(): Collection
	{
		return collect($this->errors);
	}
}