<?php

namespace Tests\Models;

use Helium\LaravelHelpers\Traits\HasEnums;
use Illuminate\Database\Eloquent\Model;
use Tests\Enums\Color;

class TestHasEnumsModel extends Model
{
	use HasEnums;

	protected $guarded = [];

	protected $enums = [
		'favorite_color' => Color::class,
		'favorite_primary_color' => Color::PRIMARY
	];
}