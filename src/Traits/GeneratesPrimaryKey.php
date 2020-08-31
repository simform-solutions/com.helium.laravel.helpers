<?php

namespace Helium\LaravelHelpers\Traits;

use Helium\LaravelHelpers\Generators\UuidPrimaryKeyGenerator;
use Helium\LaravelHelpers\Contracts\PrimaryKeyGenerator;
use Illuminate\Database\Eloquent\Model;

trait GeneratesPrimaryKey
{
	//region Helpers
	/**
	 * @description Get PrimaryKeyGenerator instance
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
	 * @description Disable incrementing ids
	 * @return bool
	 */
	public function getIncrementing()
	{
		return false;
	}

	/**
	 * @description Enable string keys
	 * @return string
	 */
	public function getKeyType()
	{
		return 'string';
	}
	//endregion

	//region Functions
    public function attemptGeneratePrimaryKey()
    {
        if (!$this->getKey())
        {
            $primaryKey = $this->getKeyName();

            $this->setAttribute(
                $primaryKey,
                $this->getPrimaryKeyGenerator()->generate()
            );
        }
    }

	/**
	 * @description Generate a unique primary key on creation
	 */
	public static function bootGeneratesPrimaryKey()
	{
		self::creating(function (Model $model) {
            /** @var GeneratesPrimaryKey $model */
		    $model->attemptGeneratePrimaryKey();
		});
	}
	//endregion
}
