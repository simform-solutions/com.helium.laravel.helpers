<?php

use Faker\Generator as Faker;
use Tests\Models\TestHasPhoneNumbersModel;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(TestHasPhoneNumbersModel::class, function (Faker $faker) {
    return [
		'phone' => $faker->phoneNumber,
	    'phone_custom' => $faker->phoneNumber
    ];
});
