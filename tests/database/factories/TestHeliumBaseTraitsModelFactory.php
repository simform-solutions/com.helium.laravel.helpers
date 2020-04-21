<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Tests\Enums\Color;
use Tests\Models\TestGeneratesPrimaryKeyModel;
use Tests\Models\TestHeliumBaseTraitsModel;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(TestHeliumBaseTraitsModel::class, function (Faker $faker) {
    return [
	    'favorite_color' => $faker->randomElement(Color::all()),
	    'favorite_primary_color' => $faker->randomElement(Color::PRIMARY),
	    'string' => $faker->word,
	    'int' => $faker->numberBetween(),
	    'bool' => $faker->boolean,
	    'foreign_key' => function (array $testSelfValidatesModel) {
		    $model = factory(TestGeneratesPrimaryKeyModel::class)->create();
		    return $model->getKey();
	    }
    ];
});