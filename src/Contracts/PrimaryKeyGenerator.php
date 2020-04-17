<?php

namespace Helium\LaravelHelpers\Contracts;

use Illuminate\Database\Eloquent\Model;

abstract class PrimaryKeyGenerator
{
	protected $model;

	public function __construct(Model $model)
	{
		$this->model = $model;
	}

	public abstract function generate(): string;
}