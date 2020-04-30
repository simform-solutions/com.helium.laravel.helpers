<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Tests\TestEnums\Color;
use Tests\TestModels\TestHasEnumsModel;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(TestHasEnumsModel::class, function (Faker $faker) {
    return [
		'favorite_color' => $faker->randomElement(Color::all()),
	    'favorite_primary_color' => $faker->randomElement(Color::PRIMARY)
    ];
});
