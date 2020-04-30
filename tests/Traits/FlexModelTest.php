<?php

namespace Tests\Traits;

use Carbon\Carbon;
use Tests\TestModels\TestFlexModel;
use Tests\TestCase;

class FlexModelTest extends TestCase
{
	protected const TEST_CLASS = TestFlexModel::class;

	protected const FLEX_ATTRIBUTE_INITIAL_VALUE = 'lorem ipsum';
	protected const FLEX_ARRAY_INITIAL_VALUE = ['a', 'b', 'c'];

	protected function getInstance()
	{
		return factory(self::TEST_CLASS)->create([
			'flex_attribute' => self::FLEX_ATTRIBUTE_INITIAL_VALUE,
			'flex_array' => self::FLEX_ARRAY_INITIAL_VALUE
		]);
	}

	public function testGetFlexColumn()
	{
		$model = $this->getInstance();

		$this->assertEquals($model->getFlexColumn(), 'data');

		$newFlexColumn = 'flex_data';
		$model->flexColumn = $newFlexColumn;

		$this->assertEquals($model->getFlexColumn(), $newFlexColumn);
	}

	public function testGetBaseColumns()
	{
		$model = $this->getInstance();

		$this->assertEquals($model->getBaseColumns(), [
			'id',
			'created_at',
			'updated_at'
		]);
	}

	public function testIsBaseAttribute()
	{
		$model = $this->getInstance();

		$this->assertTrue($model->isBaseAttribute('id'));
		$this->assertFalse($model->isBaseAttribute('data'));
		$this->assertFalse($model->isBaseAttribute('flex_attribute'));
	}

	public function testIsFlexAttribute()
	{
		$model = $this->getInstance();

		$this->assertFalse($model->isFlexAttribute('id'));
		$this->assertFalse($model->isFlexAttribute('data'));
		$this->assertTrue($model->isFlexAttribute('flex_attribute'));
	}

	public function testFilterBaseAttributes()
	{
		$model = $this->getInstance();
		$attributes = $model->getAttributes();

		$filteredAttributes = $model->filterBaseAttributes($attributes);

		$this->assertCount(3, $filteredAttributes);
		$this->assertArrayHasKey('id', $filteredAttributes);
		$this->assertEquals($filteredAttributes['id'], $attributes['id']);
		$this->assertArrayHasKey('created_at', $filteredAttributes);
		$this->assertEquals($filteredAttributes['created_at'], $attributes['created_at']);
		$this->assertArrayHasKey('updated_at', $filteredAttributes);
		$this->assertEquals($filteredAttributes['updated_at'], $attributes['updated_at']);
	}

	public function testFilterFlexAttributes()
	{
		$model = $this->getInstance();
		$attributes = $model->getAttributes();

		$filteredAttributes = $model->filterFlexAttributes($attributes);

		$this->assertCount(2, $filteredAttributes);
		$this->assertArrayHasKey('flex_attribute', $filteredAttributes);
		$this->assertEquals($filteredAttributes['flex_attribute'], $attributes['flex_attribute']);
		$this->assertArrayHasKey('flex_array', $filteredAttributes);
		$this->assertEquals($filteredAttributes['flex_array'], $attributes['flex_array']);
	}

	public function testGetBaseAttributes()
	{
		$model = $this->getInstance();
		$attributes = $model->getAttributes();

		$baseAttributes = $model->getBaseAttributes();

		$this->assertCount(3, $baseAttributes);
		$this->assertArrayHasKey('id', $baseAttributes);
		$this->assertEquals($baseAttributes['id'], $attributes['id']);
		$this->assertArrayHasKey('created_at', $baseAttributes);
		$this->assertEquals($baseAttributes['created_at'], $attributes['created_at']);
		$this->assertArrayHasKey('updated_at', $baseAttributes);
		$this->assertEquals($baseAttributes['updated_at'], $attributes['updated_at']);
	}

	public function testGetFlexAttributes()
	{
		$model = $this->getInstance();
		$attributes = $model->getAttributes();

		$flexAttributes = $model->getFlexAttributes();

		$this->assertCount(2, $flexAttributes);
		$this->assertArrayHasKey('flex_attribute', $flexAttributes);
		$this->assertEquals($flexAttributes['flex_attribute'], $attributes['flex_attribute']);
		$this->assertArrayHasKey('flex_array', $flexAttributes);
		$this->assertEquals($flexAttributes['flex_array'], $attributes['flex_array']);
	}

	public function testGetTableAttributes()
	{
		$model = $this->getInstance();
		$attributes = $model->getAttributes();

		$tableAttributes = $model->getTableAttributes();

		$this->assertCount(4, $tableAttributes);
		$this->assertArrayHasKey('id', $tableAttributes);
		$this->assertEquals($tableAttributes['id'], $attributes['id']);
		$this->assertArrayHasKey('created_at', $tableAttributes);
		$this->assertEquals($tableAttributes['created_at'], $attributes['created_at']);
		$this->assertArrayHasKey('updated_at', $tableAttributes);
		$this->assertEquals($tableAttributes['updated_at'], $attributes['updated_at']);
		$this->assertArrayHasKey('data', $tableAttributes);
		$this->assertJson($tableAttributes['data']);

		$flexAttributes = json_decode($tableAttributes['data'], true);
		$this->assertCount(2, $flexAttributes);
		$this->assertArrayHasKey('flex_attribute', $flexAttributes);
		$this->assertEquals($flexAttributes['flex_attribute'], $attributes['flex_attribute']);
		$this->assertArrayHasKey('flex_array', $flexAttributes);
		$this->assertEquals($flexAttributes['flex_array'], $attributes['flex_array']);
	}

	public function testNewFromBuilderArray()
	{
		$class = self::TEST_CLASS;
		$model = new $class;

		$flexAttributes = [
			'flex_attribute' => 'abc',
			'flex_array' => ['a', 'b', 'c']
		];

		$attributes = [
			'id' => 100,
			'created_at' => Carbon::now()->toDateTimeString(),
			'updated_at' => Carbon::now()->toDateTimeString(),
			'data' => json_encode($flexAttributes)
		];

		$model = $model->newFromBuilder($attributes);

		$modelAttributes = $model->getAttributes();

		$this->assertCount(5, $modelAttributes);
		$this->assertArrayHasKey('id', $modelAttributes);
		$this->assertEquals($modelAttributes['id'], $attributes['id']);
		$this->assertArrayHasKey('created_at', $modelAttributes);
		$this->assertEquals($modelAttributes['created_at'], $attributes['created_at']);
		$this->assertArrayHasKey('updated_at', $modelAttributes);
		$this->assertEquals($modelAttributes['updated_at'], $attributes['updated_at']);
		$this->assertArrayHasKey('flex_attribute', $modelAttributes);
		$this->assertEquals($modelAttributes['flex_attribute'], $flexAttributes['flex_attribute']);
		$this->assertArrayHasKey('flex_array', $modelAttributes);
		$this->assertEquals($modelAttributes['flex_array'], $flexAttributes['flex_array']);
	}

	public function testNewFromBuilderObject()
	{
		$class = self::TEST_CLASS;
		$model = new $class;

		$flexAttributes = [
			'flex_attribute' => 'abc',
			'flex_array' => ['a', 'b', 'c']
		];

		$attributes = [
			'id' => 100,
			'created_at' => Carbon::now()->toDateTimeString(),
			'updated_at' => Carbon::now()->toDateTimeString(),
			'data' => json_encode($flexAttributes)
		];

		//Convert array of attributes to object
		$model = $model->newFromBuilder((object) $attributes);

		$modelAttributes = $model->getAttributes();

		$this->assertCount(5, $modelAttributes);
		$this->assertArrayHasKey('id', $modelAttributes);
		$this->assertEquals($modelAttributes['id'], $attributes['id']);
		$this->assertArrayHasKey('created_at', $modelAttributes);
		$this->assertEquals($modelAttributes['created_at'], $attributes['created_at']);
		$this->assertArrayHasKey('updated_at', $modelAttributes);
		$this->assertEquals($modelAttributes['updated_at'], $attributes['updated_at']);
		$this->assertArrayHasKey('flex_attribute', $modelAttributes);
		$this->assertEquals($modelAttributes['flex_attribute'], $flexAttributes['flex_attribute']);
		$this->assertArrayHasKey('flex_array', $modelAttributes);
		$this->assertEquals($modelAttributes['flex_array'], $flexAttributes['flex_array']);
	}

	public function testGetDirtyBaseAttribute()
	{
		$model = $this->getInstance();

		$dirty = $model->getDirty();
		$this->assertEmpty($dirty);

		$newCreatedAt = Carbon::tomorrow();
		$model->created_at = $newCreatedAt;

		$dirty = $model->getDirty();
		$this->assertCount(1, $dirty);
		$this->assertArrayHasKey('created_at', $dirty);
		$this->assertEquals($dirty['created_at'], $newCreatedAt);
	}

	public function testGetDirtyFlexAttribute()
	{
		$model = $this->getInstance();

		$dirty = $model->getDirty();
		$this->assertEmpty($dirty);

		$newFlexAttribute = 'xyz';
		$model->flex_attribute = $newFlexAttribute;

		$dirty = $model->getDirty();
		$this->assertCount(1, $dirty);
		$this->assertArrayHasKey('data', $dirty);
		$this->assertJson($dirty['data']);
		$this->assertEquals($dirty['data'], json_encode($model->getFlexAttributes()));
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