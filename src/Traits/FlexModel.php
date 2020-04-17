<?php

namespace Helium\LaravelHelpers\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

trait FlexModel
{
	//region Base
	protected $baseColumns;

	protected function getFlexColumn()
	{
		return $this->flexColumn ?? 'data';
	}
	//endregion

	//region Helpers
	/**
	 * @return array
	 *
	 * Get table columns, except data
	 */
	protected function getBaseColumns()
	{
		if (!$this->baseColumns)
		{
			$columns = Schema::getColumnListing($this->getTable());

			$this->baseColumns = array_filter($columns, function($value) {
				return $value != $this->getFlexColumn();
			});
		}

		return $this->baseColumns;
	}

	/**
	 * @param $key
	 * @return bool
	 *
	 * Is the specified key a native table attribute?
	 */
	protected function isBaseAttribute($key) {
		return in_array($key, $this->getBaseColumns());
	}

	/**
	 * @param $key
	 * @return bool
	 *
	 * Is the specified key a flex attibute?
	 */
	protected function isFlexAttribute($key) {
		return !$this->isBaseAttribute($key);
	}

	/**
	 * @param array $attributes
	 * @return array
	 *
	 * Given an array of attributes, filter out the ones which are native
	 * table attributes
	 */
	protected function filterBaseAttributes(array $attributes = [])
	{
		return array_filter($attributes, function($key) {
			return $this->isBaseAttribute($key);
		}, ARRAY_FILTER_USE_KEY);
	}

	/**
	 * @param array $attributes
	 * @return array
	 *
	 * Given an array of attributes, filter out the ones which are flex attributes
	 */
	protected function filterFlexAttributes(array $attributes = [])
	{
		return array_filter($attributes, function($key) {
			return $this->isFlexAttribute($key);
		}, ARRAY_FILTER_USE_KEY);
	}

	/**
	 * @return array
	 *
	 * Get all base table attributes
	 */
	protected function getBaseAttributes()
	{
		return $this->filterBaseAttributes($this->getAttributes());
	}

	/**
	 * @return array
	 *
	 * Get all flex attributes
	 */
	protected function getFlexAttributes()
	{
		return $this->filterFlexAttributes($this->getAttributes());
	}

	/**
	 * @return array
	 *
	 * Get all attributes as they will be stored in the database
	 */
	protected function getTableAttributes()
	{
		$tableAttributes = $this->getBaseAttributes();
		$flexAttributes = $this->getFlexAttributes();

		$tableAttributes[$this->getFlexColumn()] = json_encode($flexAttributes);

		return $tableAttributes;
	}
	//endregion

	//region Model CRUD Overrides
	/**
	 * @param array $attributes
	 * @param null $connection
	 * @return Model
	 *
	 * Loads model instances from the database
	 *
	 * Override to unpack flex data json to individual properties
	 */
	public function newFromBuilder($attributes = [], $connection = null)
	{
		if (is_object($attributes))
		{
			$attributes = (array) $attributes;
		}

		if (isset($attributes[$this->getFlexColumn()]))
		{
			$json = $attributes[$this->getFlexColumn()];
			$flexData = is_array($json) ? $json : json_decode($json, true);

			unset($attributes[$this->getFlexColumn()]);
			$attributes = array_merge($attributes, $flexData);
		}

		return parent::newFromBuilder($attributes, $connection);
	}

	/**
	 * @param Builder $query
	 * @return bool
	 *
	 * Inserts new model instances into the database
	 *
	 * Override to pack flex properties into flex data json
	 */
	protected function performInsert(Builder $query)
	{
		/** BODY COPIED FROM PARENT */
		if ($this->fireModelEvent('creating') === false) {
			return false;
		}

		// First we'll need to create a fresh query instance and touch the creation and
		// update timestamps on this model, which are maintained by us for developer
		// convenience. After, we will just continue saving these model instances.
		if ($this->usesTimestamps()) {
			$this->updateTimestamps();
		}

		// If the model has an incrementing key, we can use the "insertGetId" method on
		// the query builder, which will give us back the final inserted ID for this
		// table from the database. Not all tables have to be incrementing though.
		/** MODIFIED FROM PARENT */
		$attributes = $this->getTableAttributes();
		/** END MODIFIED FROM PARENT */

		if ($this->getIncrementing()) {
			$this->insertAndSetId($query, $attributes);
		}

		// If the table isn't incrementing we'll simply insert these attributes as they
		// are. These attribute arrays must contain an "id" column previously placed
		// there by the developer as the manually determined key for these models.
		else {
			if (empty($attributes)) {
				return true;
			}

			$query->insert($attributes);
		}

		// We will go ahead and set the exists property to true, so that it is set when
		// the created event is fired, just in case the developer tries to update it
		// during the event. This will allow them to do so and run an update here.
		$this->exists = true;

		$this->wasRecentlyCreated = true;

		$this->fireModelEvent('created', false);

		return true;
	}

	/**
	 * Used in Model to generate update queries
	 *
	 * Override to pack flex properties into flex data json
	 */
	public function getDirty()
	{
		$dirty = parent::getDirty();

		$tableDirty = $this->filterBaseAttributes($dirty);
		$flexDirty = $this->filterFlexAttributes($dirty);

		//If any flex attribute is dirty, re-encode all flex attributes
		if (!empty($flexDirty))
		{
			$tableDirty[$this->getFlexColumn()] = json_encode($this->getFlexAttributes());
		}

		return $tableDirty;
	}
	//endregion
}