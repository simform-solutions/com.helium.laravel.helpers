<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Tests\TestModels\TestHasAdminsModel;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(TestHasAdminsModel::class, function (Faker $faker) {
    return [
    	'admin' => $faker->boolean
    ];
});
