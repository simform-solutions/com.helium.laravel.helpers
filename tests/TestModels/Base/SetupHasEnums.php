<?php

namespace Tests\TestModels\Base;

use Tests\TestEnums\Color;

trait SetupHasEnums
{
	protected $enums = [
		'favorite_color' => Color::class,
		'favorite_primary_color' => Color::PRIMARY
	];
}