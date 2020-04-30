<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Tests\TestModels\TestFlexModel;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(TestFlexModel::class, function (Faker $faker) {
    return [
		'flex_attribute' => $faker->word,
	    'flex_array' => $faker->words
    ];
});
