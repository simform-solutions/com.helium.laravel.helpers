<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException as IlluminateValidationException;
use Helium\LaravelHelpers\Exceptions\ValidationException as HeliumValidationException;

trait SelfValidates
{
	private $_validationRules;
	private $_validationMessages;
	private $_validatesOnSave;
	private $_preLoadedRelations;

	//region Helpers
	/**
	 * Get the list of validation rules from the model.
	 * The model may implement either a native $validationRules property
	 * or a validationRules() function, depending on the complexity or
	 * conditionality of the rules.
	 *
	 * Rules are cached locally in $_validationRules upon the first retrieval
	 * to potentially prevent inefficiencies by calling the validationRules()
	 * function multiple times.
	 *
	 * @return array
	 */
	public function getValidationRules()
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
	 * Get the list of custom validation messages from the model.
	 * The model may implement either a native $validationRules property
	 * or a validationRules() function.
	 *
	 * Messages are cached locally in $_validationMessages upon the first retrieval
	 * to potentially prevent inefficiencies by calling the validationMessages()
	 * function multiple times.
	 *
	 * @return array
	 */
	public function getValidationMessages()
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
	 * Get whether the model should validate automatically on save.
	 * The model may implement either a native $validateOnSave property
	 * or a validateOnSave() function.
	 *
	 * Messages are cached locally in $_validateOnSave upon the first retrieval
	 * to potentially prevent inefficiencies by calling the validateOnSave()
	 * function multiple times.
	 *
	 * @return bool
	 */
	public function getValidatesOnSave()
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
	 * Load all model relationships required for validation.
	 * Cache the list of relationships that were already loaded so that
	 * later, all relationships that were NOT already loaded can be unloaded
	 * to prevent unintended side effects.
	 */
	private function loadRelationsForValidation()
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
	 * Unload all model relationships that were not loaded prior to validation
	 * using the cached list of already loaded relationships from earlier.
	 */
	private function unloadUncachedRelations()
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
	 * Call validate() on save if enabled
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
	 * Perform attribute and relationship validation on the model
	 *
	 * @return array
	 * @throws HeliumValidationException
	 */
	public function validate()
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