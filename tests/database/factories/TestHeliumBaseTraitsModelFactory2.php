<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Tests\TestEnums\Color;
use Tests\TestModels\TestGeneratesPrimaryKeyModel;
use Tests\TestModels\TestHeliumBaseTraitsModel2;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(TestHeliumBaseTraitsModel2::class, function (Faker $faker) {
    return [
	    'favorite_color' => $faker->randomElement(Color::all()),
	    'favorite_primary_color' => $faker->randomElement(Color::PRIMARY),
	    'string' => $faker->word,
	    'int' => $faker->numberBetween(),
	    'bool' => $faker->boolean,
	    'foreign_key' => function (array $testSelfValidatesModel) {
		    $model = factory(TestGeneratesPrimaryKeyModel::class)->create();
		    return $model->getKey();
	    },
	    'capital_string_internal' => $faker->name,
	    'lowercase_string_internal' => $faker->name,
	    'capital_string_external' => $faker->name,
	    'lowercase_string_external' => $faker->name,
	    'capital_string_both' => $faker->name,
	    'lowercase_string_both' => $faker->name,
    ];
});
