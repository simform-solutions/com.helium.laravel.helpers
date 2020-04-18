<?php

namespace Tests\UnitTests;

use Helium\LaravelHelpers\Exceptions\ValidationException;
use Illuminate\Support\Collection;
use Tests\Models\TestSelfValidatesModel;
use Tests\Models\TestSelfValidatesModel2;
use Tests\TestCase;

/**
 * Note: It is not necessary to test every possible validation rule, since
 * SelfValidates makes use of Laravel's built-in validator.
 *
 * Rather, unit tests should cover the successful use of the suppliedconfiguration,
 * including validation rules, messages, and validatesOnSave.
 */
class SelfValidatesTest extends TestCase
{
	protected function getInstance(): TestSelfValidatesModel
	{
		return factory(TestSelfValidatesModel::class)->create();
	}

	protected function getInstance2(): TestSelfValidatesModel2
	{
		return factory(TestSelfValidatesModel2::class)->create();
	}

	//region Configuration
	public function testValidationRulesArray()
	{
		$model = $this->getInstance();

		$this->assertEquals($model->validationRules, $model->getValidationRules());
	}

	public function testValidationRulesFunction()
	{
		$model = $this->getInstance2();

		$this->assertEquals($model->validationRules(), $model->getValidationRules());
	}

	public function testValidationMessagesArray()
	{
		$model = $this->getInstance();

		$this->assertEquals($model->validationMessages, $model->getValidationMessages());
	}

	public function testValidationMessagesFunction()
	{
		$model = $this->getInstance2();

		$this->assertEquals($model->validationMessages(), $model->getValidationMessages());
	}

	public function testValidatesOnSaveAttribute()
	{
		$model = $this->getInstance();

		$this->assertEquals($model->validatesOnSave, $model->getValidatesOnSave());
	}

	public function testValidatesOnSaveFunction()
	{
		$model = $this->getInstance2();

		$this->assertEquals($model->validatesOnSave(), $model->getValidatesOnSave());
	}
	//endregion

	//region Validation
	public function testDoesNotValidateOnSave()
	{
		try
		{
			$model = factory(TestSelfValidatesModel::class)->create();

			$model->string = 123;

			$model->save();
		}
		catch (ValidationException $e)
		{
			//Fail if validation exception thrown
			$this->assertTrue(false);
			return;
		}

		$this->assertTrue(true);
	}

	public function testDoesValidateOnSave()
	{
		$this->assertThrowsException(function() {
			$model = factory(TestSelfValidatesModel::class)->create();

			$model->validatesOnSave = true;
			$model->string = 123;

			$model->save();
		}, ValidationException::class);
	}

	public function testManualValidate()
	{
		$this->assertThrowsException(function() {
			$model = factory(TestSelfValidatesModel::class)->create();

			$model->string = 123;

			$model->validate();
		}, ValidationException::class);
	}
	//endregion

	//region Exception
	public function testValidationExceptionToArray()
	{
		try
		{
			$model = factory(TestSelfValidatesModel::class)->create();

			$model->string = 123;

			$model->validate();
		}
		catch (ValidationException $e)
		{
			$this->assertIsArray($e->toArray());
			$this->assertCount(1, $e->toArray());

			return;
		}

		$this->assertTrue(false);
	}

	public function testValidationExceptionToCollection()
	{
		try
		{
			$model = factory(TestSelfValidatesModel::class)->create();

			$model->string = 123;

			$model->validate();
		}
		catch (ValidationException $e)
		{
			$this->assertInstanceOf(Collection::class, $e->toCollection());
			$this->assertCount(1, $e->toCollection());

			return;
		}

		$this->assertTrue(false);
	}

	public function testDefaultValidationMessageUsed()
	{
		try
		{
			$model = factory(TestSelfValidatesModel::class)->create();

			$messages = $model->validationMessages;
			unset($model->validationMessages);

			$model->string = 123;

			$model->validate();
		}
		catch (ValidationException $e)
		{
			$this->assertNotEquals($e->toArray()[0], $messages['string.string']);

			return;
		}

		$this->assertTrue(false);
	}

	public function testCustomValidationMessageUsed()
	{
		try
		{
			$model = factory(TestSelfValidatesModel::class)->create();

			$model->string = 123;

			$model->validate();
		}
		catch (ValidationException $e)
		{
			$this->assertEquals($e->toArray()[0], $model->getValidationMessages()['string.string']);

			return;
		}

		$this->assertTrue(false);
	}

	public function testHelpfulExceptionMessageGiven()
	{

		try
		{
			$model = factory(TestSelfValidatesModel::class)->create();

			$model->string = 123;

			$model->validate();
		}
		catch (ValidationException $e)
		{
			foreach ($e->toArray() as $message)
			{
				$this->assertStringContainsString($message, $e->getMessage());
			}

			return;
		}

		$this->assertTrue(false);
	}
	//endregion
}