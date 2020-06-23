<?php

use Faker\Generator as Faker;
use Tests\TestModels\HasPhoneNumbersModel;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(HasPhoneNumbersModel::class, function (Faker $faker) {
    return [
		'phone' => $faker->phoneNumber,
	    'phone_custom' => $faker->phoneNumber
    ];
});
