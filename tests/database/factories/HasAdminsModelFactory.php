<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Tests\TestModels\HasAdminsModel;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(HasAdminsModel::class, function (Faker $faker) {
    return [
    	'admin' => $faker->boolean
    ];
});
