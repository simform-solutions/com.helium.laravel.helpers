<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Tests\Enums\Color;
use Tests\Models\TestHasEnumsModel;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(TestHasEnumsModel::class, function (Faker $faker) {
    return [
		'favorite_color' => $faker->randomElement(Color::all()),
	    'favorite_primary_color' => $faker->randomElement(Color::PRIMARY)
    ];
});
