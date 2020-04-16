<?php

namespace Helium\LaravelHelpers\Traits;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

trait GeneratesPrimaryKey
{
	//region Helpers
	/**
	 * Get the primary key prefix, usually 3 capital characters
	 * The model may implement a native $prefix property,
	 * or one will be automatically determined basedo on the class name
	 *
	 * @return string
	 */
	protected function getPrimaryKeyPrefix(): string
	{
		if (isset($this->prefix))
		{
			return $this->prefix;
		}

		$path = explode('\\', static::class);
		$className = array_pop($path);

		return strtoupper(substr($className, 0, 3));
	}

	protected function getGeneratedValue(): string
	{
		if (method_exists($this, 'generatePrimaryKeyValue')) {
			return $this->generatePrimaryKeyValue();
		} else {
			return Uuid::uuid4()->getHex();
		}
	}
	//endregion

	//region Overrides
	public function getIncrementing()
	{
		return false;
	}
	//

	//region Functions
	/**
	 * Generate a unique primary key on creation
	 */
	public static function bootGeneratesPrimaryKey()
	{
		self::creating(function (Model $model) {
			$primaryKey = $model->getKeyName();

			$model->setAttribute($primaryKey, $model->generatePrimaryKey());
		});
	}

	public function generatePrimaryKey(): string
	{
		$prefix = $this->getPrimaryKeyPrefix();
		$value = $this->getGeneratedValue();

		return "{$prefix}-{$value}";
	}
	//endregion
}
