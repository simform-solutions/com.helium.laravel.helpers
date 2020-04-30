<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Tests\TestModels\TestGeneratesPrimaryKeyModel;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(TestGeneratesPrimaryKeyModel::class, function (Faker $faker) {
    return [
    	'string' => $faker->word
    ];
});
