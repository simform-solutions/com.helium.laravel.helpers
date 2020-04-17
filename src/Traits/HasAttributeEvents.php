<?php

namespace Helium\LaravelHelpers\Traits;

trait HasAttributeEvents
{
	//region Base
	protected static $attributeEventListners = [
		'setting_attribute' => [],
		'set_attribute_finished' => [],
		'getting_attribute' => [],
		'get_attribute_finished' => []
	];
	//endregion

	//region Helpers
	protected static function addAttributeEventListner(string $event, $callback)
	{
		self::$attributeEventListners[$event][] = $callback;
	}

	protected static function resolveAttributeEventListners(string $event, ...$args)
	{
		foreach (self::$attributeEventListners[$event] as $callback)
		{
			call_user_func_array($callback, $args);
		}
	}
	//endregion

	//region Functions
	public static function settingAttribute($callback)
	{
		self::addAttributeEventListner('setting_attribute', $callback);
	}

	public static function setAttributeFinished($callback)
	{
		self::addAttributeEventListner('set_attribute_finished', $callback);
	}

	public static function gettingAttribute($callback)
	{
		self::addAttributeEventListner('getting_attribute', $callback);
	}

	public static function getAttributeFinished($callback)
	{
		self::addAttributeEventListner('get_attribute_finished', $callback);
	}

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