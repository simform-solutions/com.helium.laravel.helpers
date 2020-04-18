<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Tests\Models\TestHasAttributeEventsModel;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(TestHasAttributeEventsModel::class, function (Faker $faker) {
    return [
    	'string' => $faker->word
    ];
});
