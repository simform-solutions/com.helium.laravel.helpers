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
		'did_set_attribute' => [],
		'getting_attribute' => [],
		'did_get_attribute' => []
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
	public static function didSetAttribute(callable $callback): void
	{
		self::addAttributeEventListner('did_set_attribute', $callback);
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
	public static function didGetAttribute(callable $callback): void
	{
		self::addAttributeEventListner('did_get_attribute', $callback);
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

		self::resolveAttributeEventListners('did_set_attribute',
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

		self::resolveAttributeEventListners('did_get_attribute',
			$this,
			$key
		);

		return $results;
	}
	//endregion
}