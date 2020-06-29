<?php

use Faker\Generator as Faker;
use Tests\TestModels\FillableOnCreateModel;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(FillableOnCreateModel::class, function (Faker $faker) {
    return [
    	'not_fillable_attribute' => $faker->word,
    	'fillable_attribute' => $faker->word
    ];
});
