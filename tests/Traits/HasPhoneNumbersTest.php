<?php

namespace Tests\Traits;

use Helium\LaravelHelpers\Exceptions\EnumException;
use Tests\TestEnums\Color;
use Tests\TestModels\HasEnumsModel;
use Tests\TestModels\HasPhoneNumbersModel;
use Tests\TestCase;

class HasPhoneNumbersTest extends TestCase
{
	protected const TEST_CLASS = HasPhoneNumbersModel::class;

	protected function getInstance()
	{
		return factory(self::TEST_CLASS)->create([
			'phone' => "000,000.0000",
			'phone_custom' => "(000) 000 - 0000"
		]);
	}

	public function testGetPhoneNumbersDefault()
	{
		$model = $this->getInstance();

		$this->assertEquals($model->getPhoneNumbers(), [
			'phone_number',
			'phone',
			'secondary_phone_number',
			'secondary_phone'
		]);
	}

	public function testGetPhoneNumbersCustom()
	{
		$model = $this->getInstance();

		$newPhoneNumbers = [
			'phone_custom'
		];
		$model->phoneNumbers = $newPhoneNumbers;

		$this->assertEquals($model->getPhoneNumbers(), $newPhoneNumbers);
	}

	public function testSetPhoneNumberCreate()
	{
		$model = $this->getInstance();

		$this->assertEquals($model->phone, '0000000000');
	}

	public function testSetPhoneNumberUpdate()
	{
		$model = $this->getInstance();

		$model->phone = "(111) 111-1111";
		$this->assertEquals($model->phone, '1111111111');

		$model->update([
			'phone' => '222-222-2222'
		]);
		$this->assertEquals($model->phone, '2222222222');
	}
}