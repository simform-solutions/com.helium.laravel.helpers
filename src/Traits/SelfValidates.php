<?php

namespace Helium\LaravelHelpers\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException as IlluminateValidationException;
use Helium\LaravelHelpers\Exceptions\ValidationException as HeliumValidationException;

trait SelfValidates
{
	protected $_validationRules;
	protected $_validationMessages;
	protected $_validatesOnSave;
	protected $_preLoadedRelations;

	//region Helpers
	/**
	 * @description Get the model validation rules
	 * @return array
	 */
	public function getValidationRules(): array
	{
		if (!$this->_validationRules) {
			if (method_exists($this, 'validationRules')) {
				$this->_validationRules = $this->validationRules();
			} else {
				$this->_validationRules = $this->validationRules ?? [];
			}
		}

		return $this->_validationRules;
	}

	/**
	 * @description Get model validation messages
	 * @return array
	 */
	public function getValidationMessages(): array
	{
		if (!$this->_validationMessages) {
			if (method_exists($this, 'validationMessages')) {
				$this->_validationMessages = $this->validationMessages();
			} else {
				$this->_validationMessages = $this->validationMessages ?? [];
			}
		}

		return $this->_validationMessages;
	}

	/**
	 * @description Determine whether the model should validate automatically on save
	 * @return bool
	 */
	public function getValidatesOnSave(): bool
	{
		if (!$this->_validatesOnSave) {
			if (method_exists($this, 'validatesOnSave')) {
				$this->_validatesOnSave = $this->validatesOnSave();
			} else {
				$this->_validatesOnSave = $this->validatesOnSave ?? true;
			}
		}

		return $this->_validatesOnSave;
	}

	/**
	 * @description Load all model relationships required for validation
	 */
	protected function loadRelationsForValidation(): void
	{
		$rules = $this->getValidationRules();

		//Store a list of relations that are already loaded for use later
		//See unloadUncachedRelations()
		$this->_preLoadedRelations = array_keys($this->getRelations());

		//Call getRelationValue() for all keys
		//Non-relationship keys simply return null, and thus have no side effects
		foreach ($rules as $key => $value) {
			$this->getRelationValue($key);
		}
	}

	/**
	 * @description Unload all model relationships that were not loaded prior to validation
	 */
	protected function unloadUncachedRelations(): void
	{
		//Get a list of all relations that were not already loaded
		//using the list of relations that WERE already loaded
		//See loadRelationsForValidation()
		$unloadRelations = array_filter($this->getRelations(), function($key) {
			return !in_array($key, $this->_preLoadedRelations);
		}, ARRAY_FILTER_USE_KEY);

		//Unload all relations that were not already loaded
		foreach ($unloadRelations as $key => $value) {
			$this->unsetRelation($key);
		}
	}
	//endregion

	//region Functions
	/**
	 * @description Validate model on save if enabled
	 */
	public static function bootSelfValidates()
	{
		self::saving(function (Model $model) {
			if ($model->getValidatesOnSave())
			{
				$model->validate();
			}
		});
	}

	/**
	 * @description Perform attribute and relationship validation on the model
	 * @return array
	 * @throws HeliumValidationException
	 */
	public function validate(): array
	{
		$rules = $this->getValidationRules();
		$messages = $this->getValidationMessages();

		//Load all necessary relationships for validation
		$this->loadRelationsForValidation();

		$v = Validator::make($this->toArray(), $rules, $messages);

		try {
			//Execute validation, which may throw a
			//Illuminate\Validation\ValidationException
			$validated = $v->validate();

			//To prevent side effects, unload all relations which were not
			//previously loaded before validation
			$this->unloadUncachedRelations();

			return $validated;
		} catch (IlluminateValidationException $e) {
			//If validation fails, re-wrap the exception as a custom
			//Helium\LaravelHelpers\Exceptions\ValidationException,
			//which is more readable than the native
			//Illuminate\Validation\ValidationException
			throw new HeliumValidationException($e);
		}
	}
	//endregion
}