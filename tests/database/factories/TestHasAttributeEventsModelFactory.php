<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Tests\TestModels\TestHasAttributeEventsModel;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(TestHasAttributeEventsModel::class, function (Faker $faker) {
    return [
    	'string' => $faker->word,
	    'capital_string_internal' => $faker->name,
	    'lowercase_string_internal' => $faker->name,
	    'capital_string_external' => $faker->name,
	    'lowercase_string_external' => $faker->name,
	    'capital_string_both' => $faker->name,
	    'lowercase_string_both' => $faker->name,
    ];
});
