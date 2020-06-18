<?php

use Faker\Generator as Faker;
use Tests\TestModels\TestBulkActionsModel;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(TestBulkActionsModel::class, function (Faker $faker) {
    return [
		'data' => $faker->words(3, true)
    ];
});
