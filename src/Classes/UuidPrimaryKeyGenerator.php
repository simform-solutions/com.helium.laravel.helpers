<?php

namespace Helium\LaravelHelpers\Classes;

use Helium\LaravelHelpers\Contracts\PrimaryKeyGenerator;
use Helium\LaravelHelpers\Helpers\StringHelper;
use Illuminate\Database\Eloquent\Model;

class UuidPrimaryKeyGenerator extends PrimaryKeyGenerator
{
	/**
	 * Get the primary key prefix, usually 3 capital characters
	 * The model may implement a native $prefix property,
	 * or one will be automatically determined basedo on the class name
	 *
	 * @return string
	 */
	protected function getPrefix(): string
	{
		if (isset($this->model->primaryKeyPrefix))
		{
			return $this->model->primaryKeyPrefix;
		}

		$namespace = explode('\\', get_class($this->model));
		$className = array_pop($namespace);

		return strtoupper(substr($className, 0, 3));
	}

	public function generate(): string
	{
		$prefix = $this->getPrefix();
		$uuid = StringHelper::uuid(false);

		return "{$prefix}-{$uuid}";
	}
}