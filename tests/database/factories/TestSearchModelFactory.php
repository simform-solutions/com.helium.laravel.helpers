<?php

use Faker\Generator as Faker;
use Tests\TestModels\TestSearchModel;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(TestSearchModel::class, function (Faker $faker) {
    return [
    	'age' => $faker->numberBetween(0, 85)
    ];
});
