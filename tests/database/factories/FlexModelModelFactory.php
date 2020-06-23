<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Tests\TestModels\FlexModelModel;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(FlexModelModel::class, function (Faker $faker) {
    return [
		'flex_attribute' => $faker->word,
	    'flex_array' => $faker->words
    ];
});
