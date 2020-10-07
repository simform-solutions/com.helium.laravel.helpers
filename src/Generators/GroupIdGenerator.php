<?php

namespace Helium\LaravelHelpers\Generators;

use Helium\LaravelHelpers\Contracts\IdGenerator;
use Helium\LaravelHelpers\Helpers\StringHelper;

class GroupIdGenerator extends IdGenerator
{
	/**
	 * @description Get the model prefix
	 * @return string
	 */
	protected function getPrefix(): string
	{
		return property_exists($this->model, 'groupIdPrefix') ? $this->model->groupIdPrefix : 'GROUP';
	}

	/**
	 * @description Generate a prefixed UUID primary key for the model
	 * @return string
	 */
	public function generate(): string
	{
		$prefix = $this->getPrefix();
		$uuid = StringHelper::uuid(false);

		return "{$prefix}-{$uuid}";
	}
}