<?php

namespace Tests\UnitTests;

use Tests\Models\TestFlexModel;
use Tests\TestCase;

class FlexModelTest extends TestCase
{
	protected const FLEX_ATTRIBUTE_INITIAL_VALUE = 'lorem ipsum';
	protected const FLEX_ARRAY_INITIAL_VALUE = ['a', 'b', 'c'];

	protected function getInstance()
	{
		return factory(TestFlexModel::class)->create([
			'flex_attribute' => self::FLEX_ATTRIBUTE_INITIAL_VALUE,
			'flex_array' => self::FLEX_ARRAY_INITIAL_VALUE
		]);
	}

	public function testInsert()
	{
		$model = $this->getInstance();

		$this->assertEquals($model->flex_attribute, self::FLEX_ATTRIBUTE_INITIAL_VALUE);
	}

	public function testUpdate()
	{
		$model = $this->getInstance();

		$flexAttributeValue = 'dolor sit';

		$model->update([
			'flex_attribute' => $flexAttributeValue
		]);

		$this->assertEquals($model->flex_attribute, $flexAttributeValue);

		$flexAttributeValue = 'amet consectetur';

		$model->flex_attribute = $flexAttributeValue;
		$model->save();

		$this->assertEquals($model->flex_attribute, $flexAttributeValue);
	}

	public function testGet()
	{
		$model = $this->getInstance();

		$id = $model->getKey();

		$model = TestFlexModel::find($id);

		$this->assertEquals($model->flex_attribute, self::FLEX_ATTRIBUTE_INITIAL_VALUE);
	}

	public function testInsertWithCasts()
	{
		$model = $this->getInstance();

		$this->assertIsArray($model->flex_array);
		$this->assertEquals($model->flex_array, self::FLEX_ARRAY_INITIAL_VALUE);
	}

	public function testUpdateWithCasts()
	{
		$model = $this->getInstance();

		$flexArrayValue = ['d', 'e', 'f'];

		$model->update([
			'flex_array' => $flexArrayValue
		]);

		$this->assertIsArray($model->flex_array);
		$this->assertEquals($model->flex_array, $flexArrayValue);

		$flexArrayValue = ['g', 'h', 'i'];

		$model->flex_array = $flexArrayValue;
		$model->save();

		$this->assertIsArray($model->flex_array);
		$this->assertEquals($model->flex_array, $flexArrayValue);
	}

	public function testGetWithCasts()
	{
		$model = $this->getInstance();

		$id = $model->getKey();

		$model = TestFlexModel::find($id);

		$this->assertIsArray($model->flex_array);
		$this->assertEquals($model->flex_array, self::FLEX_ARRAY_INITIAL_VALUE);
	}
}