<?php

namespace Helium\LaravelHelpers\Traits;

use Helium\LaravelHelpers\Classes\UuidPrimaryKeyGenerator;
use Helium\LaravelHelpers\Contracts\PrimaryKeyGenerator;
use Illuminate\Database\Eloquent\Model;

trait GeneratesPrimaryKey
{
	//region Helpers
	/**
	 * Get PrimaryKeyGenerator instance
	 *
	 * @return PrimaryKeyGenerator
	 */
	public function getPrimaryKeyGenerator(): PrimaryKeyGenerator
	{
		$generator = $this->primaryKeyGenerator ?? UuidPrimaryKeyGenerator::class;

		return new $generator($this);
	}
	//endregion

	//region Overrides
	/**
	 * Disable incrementing ids
	 *
	 * @return bool
	 */
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

			$model->setAttribute($primaryKey, $model->getPrimaryKeyGenerator()->generate());
		});
	}
	//endregion
}
