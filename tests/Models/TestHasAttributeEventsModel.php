<?php

namespace Tests\Models;

use Helium\LaravelHelpers\Traits\HasAttributeEvents;
use Illuminate\Database\Eloquent\Model;
use Tests\Enums\Color;

class TestHasAttributeEventsModel extends Model
{
	use HasAttributeEvents;

	public $_settingAttributeCalled = false;
	public $_settingAttributeKey = null;
	public $_settingAttributeValue = null;
	public $_didSetAttributeCalled = false;
	public $_didSetAttributeKey = null;
	public $_didSetAttributeValue = null;
	public $_gettingAttributeCalled = false;
	public $_gettingAttributeKey = null;
	public $_didGetAttributeCalled = false;
	public $_didGetAttributeKey = null;

	protected $guarded = [];

	protected static function boot()
	{
		static::created(function(TestHasAttributeEventsModel $model) {
			$model->_settingAttributeCalled = false;
			$model->_settingAttributeKey = null;
			$model->_settingAttributeValue = null;
			$model->_didSetAttributeCalled = false;
			$model->_didSetAttributeKey = null;
			$model->_didSetAttributeValue = null;
			$model->_gettingAttributeCalled = false;
			$model->_gettingAttributeKey = null;
			$model->_didGetAttributeCalled = false;
			$model->_didGetAttributeKey = null;
		});

		static::settingAttribute(function(TestHasAttributeEventsModel $model, $key, $value) {
			$model->_settingAttributeCalled = true;
			$model->_settingAttributeKey = $key;
			$model->_settingAttributeValue = $value;
		});

		static::didSetAttribute(function(TestHasAttributeEventsModel $model, $key, $value) {
			$model->_didSetAttributeCalled = true;
			$model->_didSetAttributeKey = $key;
			$model->_didSetAttributeValue = $value;
		});

		static::gettingAttribute(function(TestHasAttributeEventsModel $model, $key) {
			$model->_gettingAttributeCalled = true;
			$model->_gettingAttributeKey = $key;
		});

		static::didGetAttribute(function(TestHasAttributeEventsModel $model, $key) {
			$model->_didGetAttributeCalled = true;
			$model->_didGetAttributeKey = $key;
		});

		parent::boot();
	}
}