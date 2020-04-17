<?php

namespace Helium\LaravelHelpers\Traits;

trait HasAttributeEvents
{
	//region Base
	/**
	 * @description Registered event listners
	 * @var array
	 */
	protected static $attributeEventListners = [
		'setting_attribute' => [],
		'set_attribute_finished' => [],
		'getting_attribute' => [],
		'get_attribute_finished' => []
	];
	//endregion

	//region Helpers
	/**
	 * @description Register an event listener for the specified event
	 * @param string $event
	 * @param callable $callback
	 */
	protected static function addAttributeEventListner(string $event, callable $callback): void
	{
		self::$attributeEventListners[$event][] = $callback;
	}

	/**
	 * @description Trigger any registered event listeners for the specified event
	 * @param string $event
	 * @param mixed ...$args
	 */
	protected static function resolveAttributeEventListners(string $event, ...$args): void
	{
		foreach (self::$attributeEventListners[$event] as $callback)
		{
			call_user_func_array($callback, $args);
		}
	}
	//endregion

	//region Functions
	/**
	 * @description Register an event listener before setting attributes
	 * @param callable $callback
	 */
	public static function settingAttribute(callable $callback): void
	{
		self::addAttributeEventListner('setting_attribute', $callback);
	}

	/**
	 * @description Register an event listener after setting attributes
	 * @param callable $callback
	 */
	public static function setAttributeFinished(callable $callback): void
	{
		self::addAttributeEventListner('set_attribute_finished', $callback);
	}

	/**
	 * @description Register an event listener before getting attributes
	 * @param callable $callback
	 */
	public static function gettingAttribute(callable $callback): void
	{
		self::addAttributeEventListner('getting_attribute', $callback);
	}

	/**
	 * @description Register an event listener after getting attributes
	 * @param callable $callback
	 */
	public static function getAttributeFinished(callable $callback): void
	{
		self::addAttributeEventListner('get_attribute_finished', $callback);
	}
	//endregion

	//region Overrides
	/**
	 * @description Set attribute with event callbacks
	 * @param $key
	 * @param $value
	 * @return mixed
	 */
	public function setAttribute($key, $value)
	{
		self::resolveAttributeEventListners('setting_attribute',
			$this,
			$key,
			$value
		);

		$results = parent::setAttribute($key, $value);

		self::resolveAttributeEventListners('set_attribute_finished',
			$this,
			$key,
			$value
		);

		return $results;
	}

	/**
	 * @description Get attribute with event callbacks
	 * @param $key
	 * @return mixed
	 */
	public function getAttribute($key)
	{
		self::resolveAttributeEventListners('getting_attribute',
			$this,
			$key
		);

		$results = parent::getAttribute($key);

		self::resolveAttributeEventListners('get_attribute_finished',
			$this,
			$key
		);

		return $results;
	}
	//endregion
}