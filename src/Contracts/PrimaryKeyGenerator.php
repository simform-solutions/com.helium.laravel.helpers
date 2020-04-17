<?php

namespace Helium\LaravelHelpers\Contracts;

use Illuminate\Database\Eloquent\Model;

abstract class PrimaryKeyGenerator
{
	protected $model;

	/**
	 * @description PrimaryKeyGenerator constructor
	 * @param Model $model
	 */
	public function __construct(Model $model)
	{
		$this->model = $model;
	}

	/**
	 * @description Generate a string value for the model primary key
	 * @return string
	 */
	public abstract function generate(): string;
}