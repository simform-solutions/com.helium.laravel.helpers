<?php

namespace Helium\LaravelHelpers\Traits;

use Helium\LaravelHelpers\Exceptions\BatchLimitException;

trait BatchActions
{
	//region Helpers
	protected static function getLimitDataMb()
	{
		return config('batch.limit.data_mb');
	}

	protected static function getLimitDataRows()
	{
		return config('batch.limit.data_rows');
	}

	protected static function validateLimits(array $entries)
	{
		$data_mb = mb_strlen(serialize($entries));
		$data_mb_limit = self::getLimitDataMb();
		if ($data_mb > $data_mb_limit)
		{
			throw BatchLimitException::DATA_MB($data_mb, $data_mb_limit);
		}

		$data_rows = count($entries);
		$data_rows_limit = self::getLimitDataRows();
		if ($data_rows > $data_rows_limit)
		{
			throw BatchLimitException::DATA_ROWS($data_rows, $data_rows_limit);
		}
	}
	//endregion

	//region Events
	public function practiceSave()
	{

	}

	public function performSave()
	{

	}
	//endregion

	//region Actions
	public static function batchCreate (array $entries, int $chunk = 1000)
	{
		self::validateLimits($entries);

		$models = [];

		/**
		 * Check each model by instantiating the instance and running the
		 * associated saving and creating events.
		 * This step is important to run pre-creation events such as validate, which
		 * may throw an exception. If an excepiton is to be thrown, it should be
		 * thrown now during this check step, rather than during the actual insert
		 * loop.
		 */
		foreach ($entries as $entry)
		{
			$model = static::make($entry);
			$model->practiceSave();

			$models[] = $model;
		}
	}
	//endregion
}