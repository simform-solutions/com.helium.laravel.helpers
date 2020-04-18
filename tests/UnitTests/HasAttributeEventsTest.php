<?php

namespace Tests\UnitTests;

use Tests\Models\TestHasAttributeEventsModel;
use Tests\TestCase;

class HasAttributeEventsTest extends TestCase
{
	protected function getInstance(): TestHasAttributeEventsModel
	{
		return factory(TestHasAttributeEventsModel::class)->create();
	}

	public function testSettingAttribute()
	{
		$model = $this->getInstance();

		$this->assertFalse($model->_settingAttributeCalled);
		$this->assertNull($model->_settingAttributeKey);
		$this->assertNull($model->_settingAttributeValue);

		$string = 'lorem ipsum';
		$model->string = $string;

		$this->assertTrue($model->_settingAttributeCalled);
		$this->assertEquals($model->_settingAttributeKey, 'string');
		$this->assertEquals($model->_settingAttributeValue, $string);
		$this->assertFalse($model->_gettingAttributeCalled);
	}

	public function testDidSetAttribute()
	{
		$model = $this->getInstance();

		$this->assertFalse($model->_didSetAttributeCalled);
		$this->assertNull($model->_didSetAttributeKey);
		$this->assertNull($model->_didSetAttributeValue);

		$string = 'lorem ipsum';
		$model->string = $string;

		$this->assertTrue($model->_didSetAttributeCalled);
		$this->assertEquals($model->_didSetAttributeKey, 'string');
		$this->assertEquals($model->_didSetAttributeValue, $string);
		$this->assertFalse($model->_didGetAttributeCalled);
	}

	public function testGettingAttribute()
	{
		$model = $this->getInstance();

		$this->assertFalse($model->_gettingAttributeCalled);
		$this->assertNull($model->_gettingAttributeKey);

		$string = $model->string;

		$this->assertTrue($model->_gettingAttributeCalled);
		$this->assertEquals($model->_gettingAttributeKey, 'string');
		$this->assertFalse($model->_settingAttributeCalled);
	}

	public function testDidGetAttribute()
	{
		$model = $this->getInstance();

		$this->assertFalse($model->_didGetAttributeCalled);
		$this->assertNull($model->_didGetAttributeKey);

		$string = $model->string;

		$this->assertTrue($model->_didGetAttributeCalled);
		$this->assertEquals($model->_didGetAttributeKey, 'string');
		$this->assertFalse($model->_didSetAttributeCalled);
	}
}